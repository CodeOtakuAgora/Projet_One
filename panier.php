<?php
    $titlePanier = "Page Panier";
    require_once("include/require.php");

    $action = !empty($_GET['action']) ? $_GET['action'] : 'show';
    $productId = !empty($_GET['id']) ? $_GET['id'] : null;
    $quantity = !empty($_GET['quantity']) ? $_GET['quantity'] : 1;

    $user = null;
    if (!empty($_SESSION['login'])) {
        $user = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `id` = "' . $_SESSION['login'] . '"')->fetchObject();
    }

    $panier = Panier::getPanier($user->id);
    if (!$panier) {
        $panier = Panier::setPanier($user->id);
    }

    switch ($action) {
        case 'add':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if (!$product) {
                Panier::createPanierProduit($panier->id, $productId);
            } else {
                Panier::updatePanierProduit($panier->id, $productId, $product->quantity + $quantity);
            }
            break;
        case 'del':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if ($product) {
                Panier::deleteProduit($panier->id, $productId);
            }
            break;
    }

    if (isset($_REQUEST['validator'])) {
        Panier::updatePanierProduit($panier->id, $productId, $product->quantity + $quantity);
    }

    $produits = Panier::getAllProduit($panier->id);

    var_dump($produits);


?>
    <br/><br/><br/><br/>
    <table align="center" border="10px">
        <tr>
            <th>Logo</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Validation</th>
            <th>Action</th>
        </tr>
        <?php foreach ($produits as $produit) { ?>
            <?php $article = Bdd::getInstance()->conn->query(sprintf('SELECT * FROM `produits`, `panier_produit` WHERE `id` = %s', $produit['id_produit']))->fetchObject(); ?>
            <tr>
                <td><img src="ressources/vetements/<?php echo $article->logo ?>"
                         width=40 heigh=35>
                </td>
                <td><?php echo $article->nom ?></td>
                <td><?php echo $article->description ?></td>
                <td><?php echo number_format($article->prix, 2, '.', '') . ' € ' ?></td>
                <td>
                    <input style="width:50" type="number"
                           value="<?php echo $article->quantity ?>" min=1>
                </td>
                <td name="validator">
                    <a href="panier.php?action=add&id_produit=<?php echo $productId ?>">Valider</a></td>
                <td>
                    <a href="panier.php?action=del&id_produit=<?php echo $productId; ?>">Retirer du Panier</a>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php require_once('include/footer.php'); ?>