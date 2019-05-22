<?php
    //$titleProduits = "Page Produits";
    require_once('../include/db.php');
    /* Contient la connexion à la bdd */
    $catId = !empty($_GET['cat']) ? $_GET['cat'] : [];

    $ssCatId = !empty($_GET['sscat']) ? $_GET['sscat'] : [];

    $CategorieList = Categorie::getAllCategories();
    $sousCategorieList = Categorie::getAllSousCategories();
    $sousCategorieListOfCategorie = $catId ? Categorie::getSousCategoriesById($catId) : [];
    $produitListOfSousCategorie = $ssCatId ? Produit::getProduitsByIdSousCategorie($ssCatId) : []; 


?>

<div class="content">

  <table align="center" border="10px">
    <tr>
      <th>Catégories</th>
      <th>Sous-Catégories</th>

    </tr>
    <?php
    foreach ($CategorieList as $categoriesList) {
      $souscategories = '';
      var_dump($sousCategorieListOfCategorie);

      foreach ($sousCategorieListOfCategorie as $souscategoriesList) {
        $souscategories .= '<a href="produits.php?cat=' . $catId . '&sscat=' . $souscategoriesList['id'] 
        . '>' . $souscategoriesList['nom'] . '</a> | ';
        $souscategories = substr($souscategories, 0, -3);
      }

      ?>
      <tr>
        <td class="main"><b><?php echo $categoriesList['nom'] ?> : </b></td>
        <td class="main"><b><?php echo $souscategories ?> : </b></td>
         <td style="padding-left:10px;" class="sub-info"><?php echo $souscategories ?></td>

      </tr>

    <?php } ?>
  </table><br/><br/>

<table align="center" class="forum" border="10px">
  <tr class="header">
    <th class="main">Sous-Catégories</th>
    <th class="sub-info">Produits</th>
  </tr>
  <?php
  foreach ($sousCategorieList as $souscategoriesList) {
    $monProduits = '';

    foreach ($produitListOfSousCategorie as $productsList) {
      $temp = '<div><a href="articles.php?id=%s"><img style="padding-top:15px"
      src="ressources/vetements/%s" width="50" height="35">%s => %s > prix : %s €</a></div>';

      $monProduits .= sprintf($temp, $productsList['id'], $productsList['logo'], $productsList['nom'],
        $productsList['description'], number_format($productsList['prix'], 2, '.', ''));

    }
    $monProduits = substr($monProduits, 0, -3);
    ?>
    <tr>
      <td class="main"><h3><b><?php echo $souscategoriesList['nom'] ?> : </b></h3></td>
      <td style="padding-left:10px;" class="sub-info"><?php echo $monProduits ?></td>
    </tr>

  <?php } ?>
</table>

<?php require_once('include/footer.php'); ?>

</div>
