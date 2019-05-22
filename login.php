<?php

    $titleLogin = "Page de Connection";

    require_once('include/require.php');


    date_default_timezone_set('Europe/Paris');

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

    if (!isset($erreur)) {
        $result = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` LIKE "' . $_REQUEST['email'] . '" AND `password` LIKE "' . md5($_REQUEST['password']) . '"');
        if ($result != "") {
            foreach ($result as $row) {
                $_SESSION['login'] = $row['id'];
            }
            if (isset($_SESSION['login'])) {
                ?>
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

    if (isset($erreur) && isset($_POST['bouton'])) {
        echo '
        <script type="text/javascript">
            sweetAlert("Echec","' . $erreur . '","error");
        </script>';
    }

    require_once('views/login.view.php');

?>

