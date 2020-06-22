<?php

// on définit notre balise title
$titleAdminCrud = "Update du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/session.php");
require_once("../include/head.php");

require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$nomError = $descriptionError = $prixError = $categorieError = $logoError = $nom = $description = $prix = $categorie = $logo = "";

if (!empty($_POST)) {
    $nom = checkInput($_POST['nom']);
    $description = checkInput($_POST['description']);
    $prix = checkInput($_POST['prix']);
    $categorie = checkInput($_POST['categorie']);
    $logo = checkInput($_FILES["logo"]["name"]);
    $imagePath = '../ressources/vetements/' . basename($logo);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;

    if (empty($nom)) {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($prix)) {
        $priceError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if (empty($categorie)) {
        $categorieError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($logo)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
    {
        $isImageUpdated = false;
    } else {
        $isImageUpdated = true;
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

    if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) {
        $db = Database::connect();
        if ($isImageUpdated) {
            $statement = $db->prepare("UPDATE produits  set nom = ?, description = ?, prix = ?, id_categorie = ?, logo = ? WHERE id = ?");
            $statement->execute(array($nom, $description, $prix, $categorie, $logo, $id));
        } else {
            $statement = $db->prepare("UPDATE produits  set nom = ?, description = ?, prix = ?, id_categorie = ? WHERE id = ?");
            $statement->execute(array($nom, $description, $prix, $categorie, $id));
        }
        Database::disconnect();
        header("Location: admin.php");
    } else if ($isImageUpdated && !$isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM produits where id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $logo = $item['logo'];
        Database::disconnect();

    }
} else {
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM produits where id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $nom = $item['nom'];
    $description = $item['description'];
    $prix = $item['prix'];
    $categorie = $item['id_categorie'];
    $logo = $item['logo'];
    Database::disconnect();
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
        <div class="col-sm-6">
            <h1><strong>Modifier un item</strong></h1>
            <br>
            <form class="form" action="<?php echo 'update.php?id=' . $id; ?>" role="form" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom:
                        <input type="text" class="form-control" id="name" name="nom" placeholder="Nom"
                               value="<?php echo $nom; ?>">
                        <span class="help-inline"><?php echo $nomError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description:
                        <input type="text" class="form-control" id="description" name="description"
                               placeholder="Description" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Prix: (en €)
                        <input type="number" step="0.01" class="form-control" id="price" name="prix" placeholder="Prix"
                               value="<?php echo $prix; ?>">
                        <span class="help-inline"><?php echo $prixError; ?></span>
                </div>


                <div class="form-group">
                    <label for="category">Catégorie:
                        <select class="form-control" id="category" name="categorie">
                            <?php
                            $db = Database::connect();
                            foreach ($db->query('SELECT * FROM categories') as $row) {
                                if ($row['id'] == $categorie) {
                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                                }
                                else {
                                    echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                                }
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categorieError; ?></span>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <p><?php echo $logo; ?></p>
                    <label for="image">Sélectionner une nouvelle image:</label>
                    <input type="file" id="image" name="logo">
                    <span class="help-inline"><?php echo $logoError; ?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>
                        Modifier
                    </button>
                    <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span>
                        Retour</a>
                </div>
            </form>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../ressources/vetements/' . $logo; ?>" alt="...">
                <div class="price"><?php echo number_format((float)$prix, 2, '.', '') . ' €'; ?></div>
                <div class="caption">
                    <h4><?php echo $nom; ?></h4>
                    <p><?php echo $description; ?></p>
                    <a href="#" class="btn btn-order" role="button"><span
                                class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                </div>
            </div>
        </div>
    </div>
</div>