<?php
$auth_token = "Mt_7Tj1adwaaZ_ljzusbbF8ltCoRyjnvKf13p3x4DtzJewkw2Kceqw-Pl9W";

    if(isset($_POST['plugin']) and isset($_POST['auth_token']) and $_POST['auth_token'] == $auth_token){
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="plugins-dwl/'.$_POST['plugin'].'.zip"');
        readfile('plugins-dwl/'.$_POST['plugin'].'.zip');
    }

    $page = "Merci !";
    $title = "L'équipe PluginMaker.";

    if(!isset($_GET['tx'])){
        $_SESSION['error'] = "Vous n'avez pas acces a cette page!";
        session_write_close();
        header('location: /accueil');
    }

    $pp_hostname = "www.sandbox.paypal.com"; // Change to www.sandbox.paypal.com to test against sandbox
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-synch';

    $tx_token = $_GET['tx'];
    //$auth_token = "rx9XQmERjAMZcpSlrGxl1O4vc2cmUErcOj7X-QOzzFzsZhoHZf96as8HoUe";
    $req .= "&tx=$tx_token&at=$auth_token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    //set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
    //if your server does not bundled with default verisign certificates.
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
    $res = curl_exec($ch);
    curl_close($ch);
    if(!$res){
        $statue = "Oups !";
        $content .= "<p><h3>Erreur lors du paiement!</h3></p>";
        $content .= "<b>ERREUR : ".$lines[1]."</b><br>\n";
        $content .= "<b>Contacter pluginmakerfr@gmail.com ou directement via skype (Voir page L'EQUIPE)</b><br>\n";
    }else{
         // parse the data
        $lines = explode("\n", trim($res));
        $keyarray = array();
        $content = "";
        if (strcmp ($lines[0], "SUCCESS") == 0) {
            for ($i = 1; $i < count($lines); $i++) {
                $temp = explode("=", $lines[$i],2);
                $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
            }
            // check the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your Primary PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment
            $firstname = $keyarray['first_name'];
            $lastname = $keyarray['last_name'];
            $itemname = $keyarray['item_name'];
            $amount = $keyarray['mc_gross'];

            $content .= "<p><h3>Merci pour votre achat!</h3></p>";
            $content .= "<b>Details</b><br>\n";
            $content .= "<li>Nom: $firstname $lastname</li>\n";
            $content .= "<li>Objet: $itemname</li>\n";
            $content .= "<li>Montant: $amount €</li>\n";
            $content .= "";

            $content .= "<form method='POST'><input name='dwnl' type='submit' value='Télécharger le plugin' style='btn-info'><input name='plugin' hidden value='$itemname'><input name='auth_token' hidden value='$auth_token'></form>";
            $statue = "Merci !";
        }
        else if (strcmp ($lines[0], "FAIL") == 0) {
            $statue = "Oups !";
            $content .= "<p><h3>Erreur lors du paiement!</h3></p>";
            $content .= "<b>ERREUR : ".$lines[1]."</b><br>\n";
            $content .= "<b>Contacter pluginmakerfr@gmail.com ou directement via skype (Voir page L'EQUIPE)</b><br>\n";
        }
    }
?>


<section class="breadCrumArea">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <h1 class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms"><?= $statue ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="fourZeroArea">
    <div class="container">
        <div class="row">
            <?= $content ?>
        </div>
    </div>
</section>