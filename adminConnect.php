<?php

// on définit notre balise title
$titleAdminConnect = "Connection Admin";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on check l'input pour le login,password
// si il y une erreur on affecte le problème dans le variable d'erreur 
if (!isset($_REQUEST['login']) || trim($_REQUEST['login']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " \\n Le login est manquant";
    } else {
        $erreur = "Le login est manquant";
    }
}

if (!isset($_REQUEST['password']) || trim($_REQUEST['password']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " \\n Le password est manquant";
    } else {
        $erreur = "Le password est manquant";
    }
}

// si il n' a pas d'erreur
if (!isset($erreur)) {

    // on vérifie en sql que le login et le password correpondent à ce qui a été rentré
    $result = Bdd::getInstance()->conn->query('SELECT * FROM `admin` WHERE `login` LIKE "' . $_REQUEST['login'] . '" AND `password` LIKE "' . md5($_REQUEST['password']) . '"');
    if ($result != "") {

        // Si c'est bon on crée une variable session pour l'admin
        foreach ($result as $row) {
            $_SESSION['login'] = $row['login'];
        }

        if (isset($_SESSION['login'])) {
            ?>
            
            <!-- on lance l'animation de success puis on redirige sur la page principale-->
            <script type="text/javascript">
                swal({
                    title: "Succès!",
                    text: "Votre compte à bien été créé",
                    type: "success",
                }, function () {
                    window.location.href = "index.php";
                });
            </script>
            <?php
        } else {
            $erreur = " \\n Couple login/mot de passe erroné";
        }
    }

}

// si il y a des erreur et que le formulaire à été validé
// on lance l'animation d'erreur affichant la liste de toute les erreurs
if (isset($erreur) && isset($_POST['bouton'])) {

    echo '
					<script type="text/javascript">
						sweetAlert("Echec","' . $erreur . '","error");
					</script>';
}

// on inclut la vue (partie visible => front) de la page
require_once('views/adminConnect.view.php');

?>
