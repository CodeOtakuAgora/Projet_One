<?php
    $titleProduits = "Page Produits";
    require_once('include/require.php');
    /* Contient la connexion à la bdd */
    $requeteCategories = Bdd::getInstance()->conn->query('SELECT * FROM categories ORDER BY id');
    $requeteSubCategories = Bdd::getInstance()->conn->prepare('SELECT * FROM sous_categories WHERE id_categorie = ? ORDER BY id');
    $requeteSousCategories = Bdd::getInstance()->conn->query('SELECT * FROM sous_categories ORDER BY id');
    $products = Bdd::getInstance()->conn->prepare('SELECT * FROM produits WHERE id_sous_categorie = ? AND confirme = 1 ORDER BY id');


?>

    <div class="content">
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
                        <td class="main"><h3><b><?php echo $categoriesList['nom'] ?> : </b></h3></td>
                        <td style="padding-left:10px;" class="sub-info"><?php echo $souscategories ?></td>

                    </tr>

                <?php } ?>
        </table>
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
                        <td class="main"><h3><b><?php echo $souscategoriesList['nom'] ?> : </b></h3></td>
                        <td style="padding-left:10px;" class="sub-info"><?php echo $monProduits ?></td>
                    </tr>

                <?php } ?>
        </table>
    </div>
<?php require_once('include/footer.php'); ?>