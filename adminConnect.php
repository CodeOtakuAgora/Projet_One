<?php

    $titleAdminConnect = "Connection Admin";
    require_once('include/require.php');

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

    if (!isset($erreur)) {
        $result = Bdd::getInstance()->conn->query('SELECT * FROM `admin` WHERE `login` LIKE "' . $_REQUEST['login'] . '" AND `password` LIKE "' . md5($_REQUEST['password']) . '"');
        if ($result != "") {
            foreach ($result as $row) {
                $_SESSION['login'] = $row['login'];
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
                $erreur = " \\n Couple login/mot de passe erroné";
            }
        }

    }
    if (isset($erreur) && isset($_POST['bouton'])) {

        echo '
					<script type="text/javascript">
						sweetAlert("Echec","' . $erreur . '","error");
					</script>';
    }

    require_once('views/adminConnect.view.php');

?>
