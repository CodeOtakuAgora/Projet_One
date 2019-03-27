<?php
require_once('include/db.php');
require_once('include/infos.php');
require_once('include/header.php');
$get_id = htmlspecialchars($_GET['id']);
$article = $bdd->prepare('SELECT * FROM produits WHERE id = ?');
$article->execute(array($get_id));
if ($article->rowCount() == 1) {
    $article = $article->fetch();
    $logo = $article['logo'];
    $nom = $article['nom'];
    $description = $article['description'];
    $prix = $article['prix'];
} else {
    die('Cet article n\'existe pas !');
}


?>

<body><br/><br/><br/><br/><br/>
<div align="center">
    <img src="ressources/vetements/<?= $logo ?>" width="100" height="75">
    <h1><?= $nom ?></h1>
    <p><?= $description ?></p>
    <p><?= number_format($prix, 2, '.', '') . ' € ' ?></p><br/>
    <h2>Ajouter au Panier</h2>
    <br/><br/>
    <button type="submit"><a style="text-decoration: none;color:black" href="produits.php">RETOUR</a></button>
</div>
</body>
