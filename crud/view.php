<?php


// on définit notre balise title
$titleAdminCrud = "Vue du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/session.php");
require_once("../include/head.php");


require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare("SELECT produits.id, produits.nom, produits.description, produits.prix, produits.logo, produits.logo2, categories.nom AS categories FROM produits LEFT JOIN categories ON produits.id_categorie = categories.id WHERE produits.id = ?");
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();

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
            <h1><strong>Voir un item</strong></h1>
            <br>
            <form>
                <div class="form-group">
                    <label>Nom:</label><?php echo '  ' . $item['nom']; ?>
                </div>
                <div class="form-group">
                    <label>Description:</label><?php echo '  ' . $item['description']; ?>
                </div>
                <div class="form-group">
                    <label>Prix:</label><?php echo '  ' . number_format((float)$item['prix'], 2, '.', '') . ' €'; ?>
                </div>
                <div class="form-group">
                    <label>Catégorie:</label><?php echo '  ' . $item['categories']; ?>
                </div>
                <div class="form-group">
                    <label>Image:</label><?php echo '  ' . $item['logo']; ?>
                </div>
            </form>
            <br>
            <div class="form-actions">
                <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img class="card-img-top" alt="première photo"
                     src="<?php echo '../ressources/vetements/' . $item['logo']; ?>">
                <img class="card-img-top" alt="deuxième photo"
                     src="<?php echo '../ressources/vetements/' . $item['logo2']; ?>">
                <div class="price"><?php echo number_format((float)$item['prix'], 2, '.', '') . ' €'; ?></div>
                <div class="caption">
                    <h4><?php echo $item['nom']; ?></h4>
                    <p><?php echo $item['description']; ?></p>
                    <a href="#" class="btn btn-order" role="button"><span
                                class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        // on recupere toute nos images
        var x = document.getElementsByClassName("card-img-top");
        //
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
            console.log(x[i])
        }

        myIndex++;

        if (myIndex > x.length) {
            myIndex = 1
        }

        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 3000);
    }
</script>
