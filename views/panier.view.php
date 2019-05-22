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
            <?php $article = Bdd::getInstance()->conn->query(sprintf('SELECT * FROM `produits`, `panier_produit` WHERE `id` = %s', $produit['id_produit']))->fetchObject();
            $compteur++;
            ?>
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
                    <input id="quantity<?php echo $article->id ?>" style="width:50px" type="number"
                           value="<?php echo $produit['quantity'] ?>" min=1>
                </td>
                <td name="validator">
                    <a href="#" id="<?php echo $article->id ?>" quantityValid="quantity<?php echo $article->id ?>">Valider</a>
                </td>
                <td>
                    <a href="panier.php?action=del&id=<?php echo $article->id; ?>">Retirer du Panier</a>
                </td>
            </tr>

        <?php if ($article == null) { ?>
            <script type="text/javascript">
                maFonction();
            </script>
        <?php break;
        } ?>
        <?php if ($compteur > 1) { ?>

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
        <?php }
        } ?>
    </table>

    <script type="text/javascript">
        document.querySelectorAll('a[quantityValid]').forEach(function (el) {
            el.addEventListener('click', function (event) {
                var validInputId = event.currentTarget.attributes.quantityValid.value;
                var quantity = document.getElementById(validInputId).value;
                var urlAjout = "panier.php?action=add&id=" + el.id + "&quantity=" + quantity;
                document.location.href = urlAjout;
                return false;
            });
        });

        function payment() {
            var x = document.getElementById("payment");
            alert("Merci pour votre achat");
        }

        function maFonction() {
            alert("Votre panier est vide");
        }
    </script>

    <?php require_once('include/footer.php'); ?>

</div>
