<?php

// on définit notre balise title
$titleLogin = "Page de Connection";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on définit le décalage horaire par défaut de toutes les fonctions date/heure
date_default_timezone_set('Europe/Paris');

// on check l'input pour le mail,password
// si il y une erreur on affecte le problème dans le variable d'erreur 
if ((isset($_REQUEST['email'])) && (trim($_REQUEST['email']) !== '') && (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))) {
    if (isset($erreur)) {
        $erreur = $erreur . " \\n L'email n'est pas au bon format";
    } else {
        $erreur = "L'email n'est pas au bon format";
    }
}

if (!isset($_REQUEST['email']) || trim($_REQUEST['email']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " \\n L'email est manquant";
    } else {
        $erreur = "L'email est manquant";
    }
}

if (!isset($_REQUEST['password']) || trim($_REQUEST['password']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " \\n Le password est manquant";
    } else {
        $erreur = "Le password est manquant";
    }
}

// si il y a des erreur
if (!isset($erreur)) {
    // on vérifie en sql que l'email et le password correpondent à ce qui a été rentré
    $result = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` LIKE "' . $_REQUEST['email'] . '" AND `password` LIKE "' . md5($_REQUEST['password']) . '"');
    if ($result != "") {

        // Si c'est bon on crée une variable session pour le user
        foreach ($result as $row) {
            $_SESSION['login'] = $row['id'];
        }
        if (isset($_SESSION['login'])) { ?>
            <!-- on lance l'animation de success puis on redirige sur la page de connection-->
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
            $erreur = "Couple adresse mail/mot de passe erroné";
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
require_once('views/login.view.php');

?>

