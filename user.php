<?php
    $titleUser = "Page Profil";
    require_once('include/require.php');

    if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {

        function checkInput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }                                                                 

        $image = '';
        $imagePath = '';
        $imageExtension = '';
        if (isset($_POST['bouton'])) {
            $image = checkInput($_FILES["logo"]["name"]);
            $imagePath = 'ressources/vetements/' . basename($image);
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        }

        if (!isset($_REQUEST['nom']) || trim($_REQUEST['nom']) === '') {
            if (isset($erreur)) {
                $erreur = $erreur . " \\n Le nom est manquant";
            } else {
                $erreur = "Le nom est manquant";
            }
        }
        if (!isset($_REQUEST['description']) || trim($_REQUEST['description']) === '') {
            if (isset($erreur)) {
                $erreur = $erreur . " \\n La description est manquante";
            } else {
                $erreur = "La description est manquante";
            }
        }

        if (!isset($_REQUEST['prix']) || trim($_REQUEST['prix']) === '') {
            if (isset($erreur)) {
                $erreur = $erreur . " \\n Le prix est manquant";
            } else {
                $erreur = "Le prix est manquant";
            }
        }
        if (!isset($_FILES['logo'])) {
            if (isset($erreur)) {
                $erreur = $erreur . " \\n Le logo est manquant";
            } else {
                $erreur = "Le logo est manquant";
            }
        }

        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $erreur = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $erreur = "Le fichier existe deja";
            $isUploadSuccess = false;
        }

        if (!empty($_FILES["logo"]) && $_FILES["logo"]["size"] > 500000) {
            $erreur = "Le fichier ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["logo"]["tmp_name"], $imagePath)) {
                $erreur = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }

        if (!isset($erreur) && isset($_POST['bouton'])) {
            $nom = '\'' . $_REQUEST['nom'] . '\'';
            $description = '\'' . $_REQUEST['description'] . '\'';
            $prix = '\'' . $_REQUEST['prix'] . '\'';
            $logo = '\'' . basename($image) . '\'';
            $category = '\'' . $_REQUEST['category'] . '\'';
            $souscategory = '\'' . $_REQUEST['souscategory'] . '\'';
            $id_admin = 1;
            $confirme = 0;

            /**********ON EXECUTE NOS INJECTIONS SQL**********/


            // on éxecute l'insert des données pour la création du compte
            Bdd::getInstance()->conn->exec('INSERT INTO produits (nom,description,prix,logo,id_categorie,id_sous_categorie,id_admin,confirme) 
    VALUES (' . $nom . ',' . $description . ',' . $prix . ',' . $logo . ',' . $category . ',' . $souscategory . ',' . $id_admin . ',' . $confirme . ')');

            //On teste si le client à bien été inséré
            $result = Bdd::getInstance()->conn->query('SELECT * FROM `produits` WHERE `nom` LIKE "' . $nom . '"');

// Puis on redirige sur la page de connection
            ?>
            <script type="text/javascript">
                swal({
                    title: "Succès!",
                    text: "Envoie Réussi",
                    type: "success",
                });
            </script>
            <?php
        }


        if (isset($erreur) && isset($_POST['bouton'])) {
            echo '
                <script type="text/javascript">
                sweetAlert("Echec","' . $erreur . '","error");
                </script>';
        }

    }

    require_once('views/user.view.php');

?> 