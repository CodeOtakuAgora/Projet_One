<?php


// on définit notre balise title
$titleAdminCrud = "Delete du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/session.php");
require_once("../include/head.php");

require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

if (!empty($_POST)) {
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM produits WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: admin.php");
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
        <h1><strong>Supprimer un item</strong></h1>
        <br>
        <form class="form" action="delete.php" role="form" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">Oui</button>
                <a class="btn btn-default" href="admin.php">Non</a>
            </div>
        </form>
    </div>
</div>

