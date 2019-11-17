<div class="content table-responsive">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Logo</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Prix Unitaire</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Validation</th>
                <th scope="col">Action</th>
            </tr>
        </thead>        
        
        <!-- on boucle sur chaque produits en l'affectant -->
        <!-- à chaque tour de boucle à une variale temporaire -->
        <!-- en utilisant number_format le nombre du prix sera formaté en un nombre décimal -->
        <?php foreach ($produits as $produit) { ?>
            <!-- on récupére tous les produits qui ont été ajouter au panier -->
            <!-- et qui sont propre au user qui connecté -->
            <?php 

            $article = Bdd::getInstance()->conn->query(sprintf('SELECT * FROM `produits`, `panier_produit` WHERE `id` = %s', $produit['id_produit']))->fetchObject();
            ?>
        <tbody>
            <!-- on affiche toutes les infos du produits qui à été ajouter au panier -->
            <tr>
                <td><img src="ressources/vetements/<?php echo $article->logo ?>"
                         width=40 heigh=35>
                </td>
                <td><?php echo $article->nom ?></td>
                <td><?php echo $article->description ?></td>
                <td><?php echo number_format($article->prix, 2, '.', '') . ' € ' ?></td>
                <!-- on récupére le prix total actuel et on l'augmente si une nouvelle quantité est defini -->
                <?php
                $prix = $article->prix * $produit['quantity'];
                $total = $total + $prix;
                ?>
                <td><?php echo number_format($prix, 2, '.', '') . ' € ' ?></td>
                <td>
                    <input name="number" id="quantity<?php echo $article->id ?>" style="width:50px" type="number"
                           value="<?php echo $produit['quantity'] ?>" min=1>
                </td>
                <!-- on défini l'attribut quantityValid afin de pouvoir cibler cet element en javascript -->
                <!-- en sachant que le contenu de cet attribut contient la quantité actuelle -->
                <td name="validator">
                    <a href="#" id="<?php echo $article->id ?>" quantityValid="quantity<?php echo $article->id ?>">Valider</a>
                </td>
                <td>
                    <!-- on defini l'action del dans l'url ainsi que -->
                    <!-- l'id de l'article concerner par l'action -->
                    <!-- cela fera appel a plusieurs fonctions permettant -->
                    <!-- d'effectuer la fonctionnalite -->
                    <a href="panier.php?action=del&id=<?php echo $article->id; ?>">Retirer du Panier</a>
                </td>
            </tr>

        <?php } ?>
            <tr>
                <!-- on propose au user d'acheter -->
                <!-- et vider son panier -->

                <!-- on defini l'action sup dans l'url ainsi que -->
                <!-- l'id du user connecter qui est concerner par l'action -->
                <!-- cela fera appel a plusieurs fonctions permettant -->
                <!-- d'effectuer la fonctionnalite -->
                <td align="center" colspan="3">
                    <a href="panier.php?action=sup&id=<?php echo $user->id; ?>">Vider le Panier</a>
                </td>
                
                <!-- on affiche le prix total qui de base est une string c'est pourquoi on utilise le -->
                <!-- number format afin de le convertir en un nombre à virgule -->
                <td align="center">Prix Total</td>
                <td><?php echo number_format($total, 2, '.', '') . ' € ' ?></td>
                
                <!-- on defini l'action sup dans l'url ainsi que -->
                <!-- l'id du user connecter qui est concerner par l'action -->
                <!-- cela fera appel a plusieurs fonctions permettant -->
                <!-- d'effectuer la fonctionnalite -->
                <td onclick="payment()" align="center" colspan="3">
                    <a href="panier.php?action=sup&id=<?php echo $user->id; ?>">Payer</a>
                </td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>

    <!-- petit script javascript afin de récupérer dans le DOM (document object model) -->
    <!-- donc du côté client la nouvelle quantité du produit qui à été modifié et mettre à jour le prix total -->
    <!-- c'est à dire dire le récupérer grace au navigateur le valeur de la balise a -->
    <!-- avec l'attribut quantityValid une fois que le user à clické sur valider -->
    <!-- pour qu'ensuite cette valeur soit passer dans l'url -->
    <!-- afin qu'on fasse une redirection vers le panier -->
    <!-- en lui passant dans l'url l'action correspondante-->
    <!-- pour que la quantite du produit selectionner soit modifiable -->
    <!-- et mette à jour la prix total à payer et pour cela on definit l'action add --> 
    <!-- ainsi que l'id du produit qui a ete clicker et la quantite defini -->
    <!-- afin d'apeller ou de faire appel a plusieurs fonctions permettant --> 
    <!-- d'effectuer la fonctionnalite de mise à jour de la quantité sachant que le but est de récupérer -->
    <!-- la valeur qui se trouve dans l'input est de la passer dans l'url afi qu'en php on puisse --> 
    <!-- récupérer cette quantité --> 
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

    // fonction qui retourne une alerte afin d'afficher un message 
    // dans une boite de dialogue
    // une fois que l'utilisateur à clické sur payer
    function payment() {
        var x = document.getElementById("payment");
        alert("Merci pour votre achat");
    }
        
    // fonction qui retourne une alerte afin d'afficher un message dans une boite de dialogue
    // une fois que l'utilisateur à un panier qui est vide
    function maFonction() {
        alert("Votre panier est vide");
    }
    </script>
    
    
    <!-- si le panier est vide alors on affiche une alerte dialogue pour nous l'informer -->
    <?php if (!isset($article)) { ?>
        <script type="text/javascript">
            maFonction();
        </script>
    <?php } ?>
        
    
    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once('include/footer.php'); ?>

</div>
