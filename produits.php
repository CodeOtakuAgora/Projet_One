<?php
require_once('include/db.php'); /* Contient la connexion à la $bdd */
$requeteCategories = $bdd->query('SELECT * FROM categories ORDER BY id');
$requeteSubCategories = $bdd->prepare('SELECT * FROM sous_categories WHERE id_categorie = ? ORDER BY id');
$requeteSousCategories = $bdd->query('SELECT * FROM sous_categories ORDER BY id');
$products = $bdd->prepare('SELECT * FROM produits WHERE id_sous_categorie = ? ORDER BY id');
require_once('include/infos.php');
require_once('include/header.php');
?>

<br/><br/><br/><br/>
<table align="center" class="forum" border="10px">
    <tr class="header">
        <th class="main">Catégories</th>
        <th class="sub-info">Sous-Catégories</th>

    </tr>
    <?php
    while ($categoriesList = $requeteCategories->fetch()) {
        $requeteSubCategories->execute(array($categoriesList['id']));
        $souscategories = '';

        while ($souscategoriesList = $requeteSubCategories->fetch()) {
            $souscategories .= '<a href="">' . $souscategoriesList['nom'] . '</a> | ';
        }
        $souscategories = substr($souscategories, 0, -3);

        ?>
        <tr>
            <td class="main"><h3><b><?= $categoriesList['nom'] ?> : </b></h3></td>
            <td style="padding-left:10px;" class="sub-info"><?= $souscategories ?></td>

        </tr>

    <?php } ?>
</table>
<br/>
<table align="center" class="forum" border="10px">
    <tr class="header">
        <th class="main">Sous-Catégories</th>
        <th class="sub-info">Produits</th>
    </tr>
    <?php
    while ($souscategoriesList = $requeteSousCategories->fetch()) {
        $products->execute(array($souscategoriesList['id']));
        $monProduits = '';

        while ($productsList = $products->fetch()) {
            $temp = '<div><a href="articles.php?id=%s"><img style="padding-top:15px"
                src="ressources/vetements/%s" width="50" height="35">%s => %s > prix : %s €</a></div>';

            $monProduits .= sprintf($temp, $productsList['id'], $productsList['logo'], $productsList['nom'],
                $productsList['description'], number_format($productsList['prix'], 2, '.', ''));

        }
        $monProduits = substr($monProduits, 0, -3);
        ?>
        <tr>
            <td class="main"><h3><b><?= $souscategoriesList['nom'] ?> : </b></h3></td>
            <td style="padding-left:10px;" class="sub-info"><?= $monProduits ?></td>
        </tr>

    <?php } ?>
</table>
