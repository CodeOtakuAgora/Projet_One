<?php

    $titleRegister = "Page d'Inscription";
    // on inclut la connection de la session
    require_once('include/require.php');

    /********ON VERIFIE SI TOUT A ETE BIEN REMPLIS ET QUE TOUT EST CORRECT********/
    /*****SINON ON AFFECTE LA VARIABLE D'ERREUR*****/

    // Vérification adresse mail
    if ((!isset($_REQUEST['email'])) || (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))) {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le champ email n'est pas au bon format ou est incomplet";
        } else {
            $erreur = "Le champ email n'est pas au bon format ou est incomplet";
        }

    }
    // Vérification mot de passe
    if (!isset($_REQUEST['password']) || trim($_REQUEST['password']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le champ password est incomplet";
        } else {
            $erreur = "Le champ password est incomplet";
        }

    }

    // Vérification mot de passe de confirmation
    if (!isset($_REQUEST['confirm']) || trim($_REQUEST['confirm']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le mot de passe de confirmation est incomplet";
        } else {
            $erreur = "Le mot de passe de confirmation est incomplet";
        }

    }

    // Vérification correspondance deux mots de passe
    if (isset($_REQUEST['confirm']) && isset($_REQUEST['password']) && ($_REQUEST['confirm']) != ($_REQUEST['password'])) {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Les deux mots de passe ne correspondent pas";
        } else {
            $erreur = "Les deux mots de passe ne correspondent pas";
        }

    }

    // Vérification nom
    if (!isset($_REQUEST['nom']) || trim($_REQUEST['nom']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le champ nom est incomplet";
        } else {
            $erreur = "Le champ nom est incomplet";
        }

    }

    // Vérification prénom
    if (!isset($_REQUEST['prenom']) || trim($_REQUEST['prenom']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le  champ prenom est incomplet";
        } else {
            $erreur = "Le champ prenom est incomplet";
        }

    }

    // Vérification rue
    if (!isset($_REQUEST['rue']) || trim($_REQUEST['rue']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le champ adresse est incomplet";
        } else {
            $erreur = "Le champ adresse est incomplet";
        }

    }

    // Vérification code postal
    if (!isset($_REQUEST['cp']) || trim($_REQUEST['cp']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le champ code postal est incomplet";
        } else {
            $erreur = "Le champ code postal est incomplet";
        }

    }

    // Vérification ville
    if (!isset($_REQUEST['ville']) || trim($_REQUEST['ville']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le champ ville est incomplet";
        } else {
            $erreur = "Le champ ville est incomplet";
        }

    }

    // Vérification telephone
    if (!isset($_REQUEST['telportable']) || trim($_REQUEST['telportable']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Veuillez renseigner un numéro de télphone";
        } else {
            $erreur = "Veuillez renseigner un numéro de télphone";
        }

    } else if (!preg_match("#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#", $_REQUEST['telportable']) && $_REQUEST['telportable'] != NULL) {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le numéro de téléphone renseigné n'est pas au bon format";
        } else {
            $erreur = "Le numéro de téléphone portable n'est pas au bon format";
        }

    }

    /**********ON AFFICHE LES ERREURS SI IL Y EN A**********/

    if (isset($_POST['bouton']) && isset($erreur)) {
        echo '
                    <script type="text/javascript">
                        sweetAlert("Echec","' . $erreur . '","error");
                    </script>';
    }


    /**********AFFECTATION DES VARIABLES**********/

    if (isset($_POST['bouton']) && !isset($erreur)) {
        $email = '\'' . $_REQUEST['email'] . '\'';
        $emailbis = $_REQUEST['email'];
        $password = '\'' . md5($_REQUEST['password']) . '\'';
        $mdpbis = md5($_REQUEST['password']);
        $confirm = md5($_REQUEST['confirm']) . '\'';

        $nom = '\'' . $_REQUEST['nom'] . '\'';
        $prenom = '\'' . $_REQUEST['prenom'] . '\'';
        $rue = '\'' . $_REQUEST['rue'] . '\'';
        $cp = '\'' . $_REQUEST['cp'] . '\'';
        $ville = '\'' . $_REQUEST['ville'] . '\'';
        $portable = '\'' . $_REQUEST['telportable'] . '\'';

        /**********ON EXECUTE NOS INJECTIONS SQL**********/


        // on éxecute l'insert des données pour la création du compte
        Bdd::getInstance()->conn->exec('INSERT INTO users (nom,prenom,rue,code_postal,ville,mail,telephone,
            password) VALUES (' . $nom . ',' . $prenom . ',' . $rue . ',' . $cp . ',' . $ville . ',' . $email . ',' . $portable . ',' . $password . ')');

        //On teste si le client à bien été inséré
        $result = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` LIKE "' . $emailbis . '" AND `password` LIKE "' . $mdpbis . '"');

        // Si c'est bon on crée une variable session
        while ($row = $result->fetch()) {
            $_SESSION['login'] = $row['id'];
        }

// Puis on redirige sur la page de connection
        ?>
        <script type="text/javascript">
            swal({
                title: "Succès!",
                text: "Votre compte à bien été créé",
                type: "success",
            }, function () {
                window.location.href = "login.php";
            });
        </script>
        <?php
    }


?>

    <!-- Le formulaire de création de compte -->
    <div class="content">
        <div class="contenupage">
            <div class="container">
                <div class="row">
                    <div class="formulaireinscription">
                        <form class="registerr" action="register.php" id="myForm" method="POST"
                              enctype="multipart/form-data">
                            <h1 style="text-align:center;">Inscription</h1>
                            <h2>Paramètres d'inscription</h2>
                            <input name="email" type="text" value="" size="30" placeholder="Adresse Mail"/>
                            <input name="password" type="password" value="" size="30"
                                   placeholder="Mot de Passe"/>
                            <input name="confirm" type="password" value="" size="30" placeholder="Confirmation"/>
                            <h2>Coordonnées personnelles</h2>
                            <input name="nom" type="text" value="" size="30" placeholder="Nom*"/>
                            <input name="prenom" type="text" value="" size="30" placeholder="Prénom*"/>
                            <input name="rue" type="text" value="" size="30" placeholder="Adresse*"/>
                            <input name="cp" type="text" value="" size="30"
                                   placeholder="Code Postal*"/>
                            <input name="ville" type="text" value="" size="30" placeholder="Ville*"/>
                            <input name="telportable" type="text" value="" size="30" placeholder="Téléphone Portable*"/>
                            <input name="bouton" type="submit" id="sinscrire" value="Valider"
                                   onclick="document.forms['myForm'].submit();"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('include/footer.php'); ?>