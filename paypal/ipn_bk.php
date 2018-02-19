<?php
define("HOST", "localhost");
define("USER", "pluginmaker");
define("PASSWORD", "bsdBH249");
define("DATABASE", "pluginmaker");

/*error_reporting(-1);
ini_set('display_errors','On');
mb_internal_encoding('UTF-8');
date_default_timezone_set("Europe/Paris");*/

include('../includes/mail_functions.php');

require('SPDO.php');
$pdo = SPDO::getInstance();

// Set this to true to use the sandbox endpoint during testing:
$enable_sandbox = true;
// Use this to specify all of the email addresses that you have attached to paypal:
$my_email_addresses = array("my_email_address@gmail.com", "my_email_address2@gmail.com", "my_email_address3@gmail.com");
// Set this to true to send a confirmation email:
$send_confirmation_email = true;
$confirmation_email_address = "My Name <my_email_address@gmail.com>";
$from_email_address = "My Name <my_email_address@gmail.com>";
// Set this to true to save a log file:
$save_log_file = true;
$log_file_dir = __DIR__ . "/logs";

// Here is some information on how to configure sendmail:
// http://php.net/manual/en/function.mail.php#118210

require('PaypalIPN.php');
$data_text = "";
foreach ($_POST as $key => $value) {
    $post .= $key . " = " . $value . "\r\n";
}

$ipn = new PaypalIPN();
if ($enable_sandbox) {
    $ipn->useSandbox();
}

$verified = $ipn->verifyIPN();

if ($verified) {
    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     */

    // VARIABLES POUR TESTER SANS API PAYPAL
    //$_POST['custom'] = "5//11";
    //$auth_amount = 1.49;

    // Si la variable custom a été envoyé par paypal
    if(isset($_POST['custom']))
    {
        // 0 : numéro client
        // 1 : numéro service
        // 2 : nom reduction [FACULTATIF]
        $customs = explode("//", $_POST['custom']);
        // Si il y a au moins 2 entrées dans le tableau et que le premier est un chiffre
        if(count($customs) >= 2 AND is_numeric($customs[0]))
        {
            $userid = $customs[0];
            $pluginid = $customs[1];

            // Récupère le prix et le numéro de service pour le service
            $sth = $pdo->prepare("SELECT plugin_price, plugin_name from plugin where plugin_id = ? LIMIT 1");
            $sth->execute(array($pluginid));
            $row = $sth->fetch(PDO::FETCH_BOTH);

            // Si le numéri de service existe
            if ($row)
            {
                // On récupère le prix payé
                $auth_amount = (isset($_POST['mc_gross'])) ? $_POST['mc_gross'] : 0;
                $prixTTC = $row[0];
                $pluginname = $row[1];

                // Si la personne a utilisé un coupon de réduction
                if(isset($customs[2]))
                {
                    $idCoupon = $customs[2];

                    // On récupère les informations du coupon utilisé
                    $sth = $pdo->prepare("SELECT coup_type, coup_percent, coup_fixe, coup_active, coup_dateFin from coupons where coup_id = ? LIMIT 1");
                    $sth->execute(array($idCoupon));
                    $tabCoupon = $sth->fetch(PDO::FETCH_BOTH);

                    // Si le coupon existe
                    if($tabCoupon)
                    {
                        // Si c'est de type 1 (réduction en pourcentage)
                        if($tabCoupon['coup_type'] == 1)
                        {
                            // On applique la réduction
                            $newPrix = round($prixTTC - $prixTTC*$tabCoupon['coup_percent']/100,2);
                            // On marqué le type de réduction et le montant pour les logs si erreur
                            $reduc = $tabCoupon['coup_percent'].'%';
                        }
                        // Si c'est de type 2 (réduction en montant fixe)
                        else if($tabCoupon['coup_type'] == 2)
                        {
                            // On applique la réduction
                            $newPrix = round($prixTTC - $tabCoupon['coup_fixe'],2);
                            // On marqué le type de réduction et le montant pour les logs si erreur
                            $reduc = $tabCoupon['coup_fixe'].'€';
                        }
                    } else
                        $subq = "INSERT INTO logs_commandes (u_id, plugin_prix, plugin_name, log_comment, log_date) VALUES ($userid,$auth_amount,$pluginid,'le coupon existe pas id:".$idCoupon."', now())";
                }
                // Si il y a eu une réduction et que le prix réduit est égal au prix payé sur paypal
                // OU
                // Si il n'y a pas eu de réduction et que le prix normal est égal au prix payé sur paypal
                if((isset($newPrix) AND $newPrix == $auth_amount) OR (!isset($newPrix) AND $prixTTC == $auth_amount))
                {
                    // Récupération du futur commande id
                    $sth = $pdo->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'pluginmaker' AND TABLE_NAME = 'commandes'");
                    $sth->execute();
                    $aiNumber = $sth->fetch(PDO::FETCH_BOTH);
                    $aiNumber = $aiNumber[0];

                    // Gestion parrainage
                    //$queryParrain = "SELECT u_id_parrain FROM hs_parrainages WHERE u_id_parraine = ?";
                    //$prepareParrain = $pdo->prepare($queryParrain);
                    //$prepareParrain->execute(array($userid));

                    //$parrain = $prepareParrain->fetch(PDO::FETCH_BOTH);
                    /*if ($parrain)
                    {
                        $queryCommande = "SELECT u_id FROM hs_commandes WHERE u_id = ?";
                        $prepareCommande = $pdo->prepare($queryCommande);
                        $prepareCommande->execute(array($userid));
                        $commande = $prepareCommande->fetch(PDO::FETCH_BOTH);

                        if (!$commande)
                        {
                            $queryUser = "SELECT u_email FROM hs_users WHERE u_id = ?";
                            $prepareUser = $pdo->prepare($queryUser);
                            $prepareUser->execute(array($parrain['u_id_parrain']));
                            $user = $prepareUser->fetch(PDO::FETCH_BOTH);

                            if($user){
                                $creditPlus = round(0.2*$prixTTC,2);
                                $queryUpdate = "UPDATE hs_users SET u_credit = u_credit+$creditPlus WHERE u_id = ?";
                                $prepareUpdate = $pdo->prepare($queryUpdate);
                                $prepareUpdate->execute(array($parrain['u_id_parrain']));

                                $email = $user["u_email"];

                                ob_start();
                                    include('../heavyserver/admin/email_template/parrainage.php');
                                    $message = ob_get_contents();
                                ob_end_clean();
                                sendMail($email, "HeavyServer - Votre filleul a commandé !", $message);
                            }
                        }
                    }*/

                    // Génération numéro unique
                    $uniqueid = $pluginname.'-'.$aiNumber.$userid.rand(10,99);
                    // On insère la commande dans la base de données !
                    $sth = $pdo->prepare("INSERT INTO commandes (com_uniqueid, u_id, plugin_id, etat_id, com_dateAchat) VALUES (?,?,?,2,now())");
                    $sth->execute(array($uniqueid, $userid, $pluginid));

                    $queryId = "SELECT com_id FROM commandes WHERE com_uniqueid = ?";
                    $prepare = $pdo->prepare($queryId);
                    $prepare->execute(array($uniqueid));

                    $com_id = $prepare->fetch(PDO::FETCH_BOTH);
                    $com_id = $com_id[0];

                    $query = "INSERT INTO factures (com_id,facture_unique, facture_date) VALUES(?,?,SYSDATE())";
                    $prepare = $pdo->prepare($query);
                    $prepare->execute(array($com_id,uniqid()));


                } else {
                    // Sinon si il n'y a pas déja eu de requete de logs de créé
                    if(!isset($subq))
                    {
                        // Si il y a eu une réduction de faite, log spéciale
                        if(isset($newPrix))
                            $subq = "INSERT INTO logs_commandes (u_id, plugin_prix, plugin_name, log_comment, log_date) VALUES ($userid,$auth_amount,$pluginid,'prix pas exacte ; bdd avec reduc de $reduc: $newPrix vs paypal: $auth_amount', now())";
                        else
                            $subq = "INSERT INTO logs_commandes (u_id, plugin_prix, plugin_name, log_comment, log_date) VALUES ($userid,$auth_amount,$pluginid,'prix pas exacte ; bdd: $prixTTC vs paypal: $auth_amount', now())";
                    }
                }
            } else
                $subq = "INSERT INTO logs_commandes (u_id, plugin_prix, plugin_name, log_comment, log_date) VALUES ($userid,$auth_amount,null,'erreur recup lignes bdd', now())";
        } else
            $subq = "INSERT INTO logs_commandes (log_comment, log_date) VALUES ('variable custom non conforme', now())";
    } else
        $subq = "INSERT INTO logs_commandes (log_comment, log_date) VALUES ('pas de variable custom', now())";
} else
    $subq = "INSERT INTO logs_commandes (log_comment, log_date) VALUES ('erreur paypal ipn', now())";

// Si il y a eu une requête pour logs, on l'insère dans la base de données
if(isset($subq)){
    $sthsubq = $pdo->prepare($subq);
    $sthsubq->execute();
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");