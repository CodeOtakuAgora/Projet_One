<?php
    $titleUser = "Page Profil";
    require_once('include/require.php');
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
            $erreur = $erreur . " \\n La description ets manquante";
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


    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
    echo ' <div class=""content>
<div style="display: flex;justify-content: center;">
<a style="color:red;font-size:25px;"
href="deconnection.php">SE DECONNECTER</a>
</div>'; ?>

    <h2 style="font-weight: bold;" align="center">Vendre un Produit</h2>
    <div class="container">


        <form method="POST" enctype="multipart/form-data">
            <input name="nom" type="text" placeholder="nom du produit">
            <input name="description" type="text" placeholder="description du produit">
            <input name="prix" step="0.01" type="number" placeholder="prix du produit">
            <input name="logo" type="file" placeholder="logo du produit">
            <select name="category">
                <?php
                    foreach (Bdd::getInstance()->conn->query('SELECT * FROM categories') as $row) {
                        echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';;
                    }
                ?>
            </select>
            <select name="souscategory">
                <?php
                    foreach (Bdd::getInstance()->conn->query('SELECT * FROM sous_categories') as $row) {
                        echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';;
                    }
                ?>
            </select>
            <input name="bouton" type="submit" value="Valider">
        </form>
    </div></div>

<?php

    require_once('include/footer.php');

?>