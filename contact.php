<!-- on définis notre titre dynamique de la page -->

<?php 
    $titleContact = "Page Contact"; 
    require_once('include/require.php');

	if(isset($_POST['mailform'])) {
	   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
	      $header="MIME-Version: 1.0\r\n";
	      $header.='From:"nom_d\'expediteur"<hwear@gmail.com>'."\n";
	      $header.='Content-Type:text/html; charset="uft-8"'."\n";
	      $header.='Content-Transfer-Encoding: 8bit';
	      $message='
	      <html>
	         <body>
	            <div align="center">
	               <img src="http://www.primfx.com/mailing/banniere.png"/>
	               <br />
	               <u>Nom de l\'expediteur :</u>'.$_POST['nom'].'<br />
	               <u>Prenom de l\'expediteur :</u>'.$_POST['prenom'].'<br />
	               <u>Mail de l\'expediteur :</u>'.$_POST['mail'].'<br />
	               <br />
	               '.nl2br($_POST['message']).'
	               <br />
	               <img src="http://www.primfx.com/mailing/separation.png"/>
	            </div>
	         </body>
	      </html>
	      ';
	      mail("mailto:arthur.boutonnet@gmail.com,hfief1806@gmail.com,bastian.peire@gmail.com", 
	      	"Sujet du message", $message, $header);
	      $msg="Votre message a bien été envoyé !";
	   } else {
	      $msg="Tous les champs doivent être complétés !";
	   }
	}

    require_once('views/contact.view.php'); 

?>


