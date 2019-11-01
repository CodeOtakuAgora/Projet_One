<?php
// on définit notre balise title
$titleContact = "Page Contact";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// si le formulaire à bien été validé et que les inputs ne sont pas vides 
if (isset($_POST['mailform'])) {
    if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
    	// on définit l'entete du mail en spécifiant certains configuration 
        $header = "MIME-Version: 1.0\r\n";
        $header .= 'From:"nom_d\'expediteur"hfief1806@gmail.com' . "\n";
        $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
        $header .= 'Content-Transfer-Encoding: 8bit';
        // on définit l'affichage du contenu du mail en affichant les valeurs 
        // de ce qui à été rentré dans les inouts
        $message = '
	      <html>
	         <body>
	            <div align="center">
	               <img src="http://www.primfx.com/mailing/banniere.png"/>
	               <br />
	               <u>Nom de l\'expediteur :</u>' . $_POST['nom'] . '<br />
	               <u>Prenom de l\'expediteur :</u>' . $_POST['prenom'] . '<br />
	               <u>Mail de l\'expediteur :</u>' . $_POST['mail'] . '<br />
	               <br />
	               ' . nl2br($_POST['message']) . '
	               <br />
	               <img src="http://www.primfx.com/mailing/separation.png"/>
	            </div>
	         </body>
	      </html>
	      ';
	    // on définit les destinataires du mail, le sujet, message, et l'entete car le mot clé mail 
	    //qui avec toutes les infos présents dand les vairables va s'occuper d'envoyer le mail
        mail("mailto:boutonnet.arthur@gmail.com,hfief1806@gmail.com,bastian.peire@gmail.com",
            "Sujet du message", $message, $header);
        $msg = "Votre message a bien été envoyé !";
    } else {
        $msg = "Tous les champs doivent être complétés !";
    }
}

// on inclut la vue (partie visible => front) de la page
require_once('views/contact.view.php');

?>


