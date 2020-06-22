<?php

// on définit notre balise title
$titleAdminCrud = "Insert du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/session.php");
require_once("../include/head.php");

require 'database.php';

$nomError = $descriptionError = $prixError = $categorieError = $souscategorieError = $logoError = $nom = $description = $prix = $categorie = $souscategorie = $logo = "";

if (!empty($_POST)) {
    $nom = checkInput($_POST['nom']);
    $description = checkInput($_POST['description']);
    $prix = checkInput($_POST['prix']);
    $categorie = checkInput($_POST['categorie']);
    $souscategorie = checkInput($_POST['souscategorie']);
    $logo = checkInput($_FILES["logo"]["name"]);
    $imagePath = '../ressources/vetements/' . basename($logo);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;
    $isUploadSuccess = false;
    echo 'ftggggg';


    if (empty($nom)) {
        $nomError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($prix)) {
        $prixError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($categorie)) {
        $categorieError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($souscategorie)) {
        $souscategorieError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($logo)) {
        $logorror = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    } else {
        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = "Le fichier existe deja";
            $isUploadSuccess = false;
        }
        if ($_FILES["logo"]["size"] > 500000) {
            $imageError = "Le fichier ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["logo"]["tmp_name"], $imagePath)) {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }

    if ($isSuccess && $isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO produits (nom,description,prix,id_categorie,id_sous_categorie,logo) values(?, ?, ?, ?, ?, ?)");
        $statement->execute(array($nom, $description, $prix, $categorie, $souscategorie, $logo));
        Database::disconnect();
        header("Location: admin.php");
    }
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

?>

<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span
            class="glyphicon glyphicon-cutlery"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Ajouter un item</strong></h1>
        <br>
        <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="name" name="nom" placeholder="Nom"
                       value="<?php echo $nom; ?>">
                <span class="help-inline"><?php echo $nomError; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description"
                       value="<?php echo $description; ?>">
                <span class="help-inline"><?php echo $descriptionError; ?></span>
            </div>
            <div class="form-group">
                <label for="price">Prix: (en €)</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" placeholder="Prix"
                       value="<?php echo $prix; ?>">
                <span class="help-inline"><?php echo $prixError; ?></span>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select class="form-control" id="category" name="categorie">
                    <?php
                    $db = Database::connect();
                    foreach ($db->query('SELECT * FROM categories') as $row) {
                        echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <span class="help-inline"><?php echo $categorieError; ?></span>
            </div>
            <div class="form-group">
                <label for="souscategorie">Sous Catégorie:</label>
                <select class="form-control" id="souscategory" name="souscategorie">
                    <?php
                    $db = Database::connect();
                    foreach ($db->query('SELECT * FROM sous_categories') as $row) {
                        echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <span class="help-inline"><?php echo $souscategorieError; ?></span>
            </div>
            <div class="form-group">
                <label for="logo">Sélectionner une image:</label>
                <input type="file" id="image" name="logo">
                <span class="help-inline"><?php echo $logoError; ?></span>
            </div>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter
                </button>
                <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </form>
    </div>
</div>