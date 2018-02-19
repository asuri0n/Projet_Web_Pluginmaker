<?php
function sendMail($mail,$subject,$texte) {
    echo "in";
    $passage_ligne = "\n";

    $message_txt = $texte;
    $message_html = "<html><head></head><body>".$texte."</body></html>";
    //==========
     
    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    //==========

     
    //=====Création du header de l'e-mail.
    $header = "From: \"Plugin Maker\" <support@pluginmaker.fr>".$passage_ligne;
    $header.= "Reply-to: \"Client\" <".$mail.">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "X-Priority: 1".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========
     
    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========

    //=====Envoi de l'e-mail.
    return mail($mail,$subject,$message,$header);
}

function sendMailConfirmation($id) {
    $pdo = SPDO::getInstance(); 
    $prep_stmt = "SELECT u_nom, u_prenom, u_email, u_actif, u_actif_token FROM hs_users WHERE u_id = ? LIMIT 1";
    $stmt = $pdo->prepare($prep_stmt);
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_OBJ);

    if($row)
    {
        if(!$row->u_actif and $row->u_actif_token)
        {
            $token = $row->u_actif_token;
            $email = $row->u_email;
            $nom = strtoupper($row->u_nom).' '.ucfirst($row->u_prenom);
            ob_start();
                include('./admin/email_template/confirmation_inscription.php');
                $message = ob_get_contents();
            ob_end_clean();
            sendMail($email, "HeavyServer - Confirmation de votre adresse mail", $message);
        }
    }
}

function sendMailPassword($link, $to) {
    ob_start();
        include('./admin/email_template/recovery_password.php');
        $message = ob_get_contents();
    ob_end_clean();
    sendMail($to, "HeavyServer - Récupération mot de passe", $message);
}

function sendMailParrainageConfiremation($parrain, $link, $to) {
    ob_start();
        include('./admin/email_template/confirmation_parrainage.php');
        $message = ob_get_contents();
    ob_end_clean();
    sendMail($to, "HeavyServer - Demande de parrainage de la part de ".$parrain, $message);
}