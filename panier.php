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
                Panier::updatePanierProduit($panier->id, $productId, $quantity);
            }
            break;
        case 'del':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if ($product) {
                Panier::deleteProduit($panier->id, $productId);
            }
            break;
        case 'sup':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if ($product) {
                Panier::deletePanier($panier->id, $productId);
            }
            break;
    }

    if (isset($_REQUEST['validator'])) {
        Panier::updatePanierProduit($panier->id, $productId, $product->quantity + $quantity);
    }

    $produits = Panier::getAllProduit($panier->id);

    $total = 0;

?>
    <div class="content">
        <table align="center" border="10px">
            <tr>
                <th>Logo</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix Unitaire</th>
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
                    <?php
                        $prix = $article->prix * $produit['quantity'];
                        $total = $total + $prix;
                    ?>
                    <td><?php echo number_format($prix, 2, '.', '') . ' € ' ?></td>
                    <td>
                        <input id="quantity<?php echo $article->id ?>" style="width:50" type="number"
                               value="<?php echo $produit['quantity'] ?>" min=1>
                    </td>
                    <td name="validator">
                        <a href="#" id="<?php echo $article->id ?>" quantityValid="quantity<?php echo $article->id ?>">Valider</a>
                    </td>
                    <td>
                        <a href="panier.php?action=del&id=<?php echo $article->id; ?>">Retirer du Panier</a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td align="center" colspan="3">
                    <a href="panier.php?action=sup&id=<?php echo $article->id; ?>">Vider le Panier</a>
                </td>
                <td align="center">Prix Total</td>
                <td><?php echo number_format($total, 2, '.', '') . ' € ' ?></td>
                <td onclick="payment()" align="center" colspan="3">
                    <a href="panier.php?action=sup&id=<?php echo $article->id; ?>">Payer</a>
                </td>
            </tr>
        </table>
    </div>


    <script type="text/javascript">
        document.querySelectorAll('a[quantityValid]').forEach(function (el) {
            el.addEventListener('click', function (event) {
                var validInputId = event.currentTarget.attributes.quantityValid.value;
                var quantity = document.getElementById(validInputId).value;
                console.log(quantity);
                console.log(el.id);
                var urlAjout = "panier.php?action=add&id=" + el.id + "&quantity=" + quantity;
                document.location.href = urlAjout;
                return false;
            });
        });

        function payment() {
            var x = document.getElementById("payment");
            alert("Merci pour votre achat");
        }

    </script>
<?php require_once('include/footer.php'); ?>