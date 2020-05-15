<!-- si un article à bien été selectionné -->
<!-- en utilisant number_format le nombre du prix sera formaté en un nombre décimal -->
<?php if ($article) { ?>
    <div class="row" style="display: flex;justify-content: center;">
        <div class="card" style="width: 18rem;">
            <form action="panier.php">
                <img class="card-img-top" src="ressources/vetements/<?php echo $logo ?>"
                     width="250px" height="250px" alt="première photo">
                <img class="card-img-top" src="ressources/vetements/<?php echo $logo2 ?>"
                     width="250px" height="250px" alt="deuxième photo">
                <div class="card-body">
                    <h1 class="card-title"><?php echo $nom ?></h1>
                    <p class="card-text"><?php echo $description ?>
                        <?php echo " / Prix : " . number_format($prix, 2, '.', '') . ' € ' ?>
                        <?php if (isset($_SESSION['login'])) {
                            ?>
                            <!-- on defini l'action add dans l'url ainsi que -->
                            <!-- l'id de l'article concerner par l'action -->
                            <!-- cela fera appel a plusieurs fonctions permettant -->
                            <!-- d'effectuer la fonctionnalite -->
                            <a class="btn btn-primary" href="panier.php?action=add&id=<?php echo $get_id; ?>">Ajouter au
                                Panier</a>
                        <?php } else {
                            ?><a class="btn btn-primary" href="login.php">Ajouter au Panier</a>
                        <?php } ?>
                </div>
            </form>
        </div>
    </div>

    <h2 style="text-align: center">Espace Commentaires :</h2>
    <form method="POST">
        <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo"/>
        <textarea class="form-control" rows="3" name="commentaire" placeholder="Votre commentaire..."></textarea>
        <input type="submit" value="Poster mon commentaire" name="submit_commentaire"/>
    </form>
    <!-- si il y un message à afficher alors affiche le -->
    <?php if (isset($c_msg)) {
        echo $c_msg;
    } ?>
    <!-- on boucle sur chaque commentaires en l'affectant -->
    <!-- à chaque tour de boucle à une variable temporaire -->
    <?php foreach ($commentaires as $c) { ?>
        <p style="text-align: center">
            <strong>
                Pseudo : <?php echo $c['pseudo'] ?>
                / Commentaire : <?php echo $c['message'] ?>
                / Fait le : <?php echo $c['date_creation']; ?>
            </strong>
        </p>
    <?php }
} ?>

<!-- petit script javascript afin de récupérer dans le DOM (document object model) -->
<!-- c'est a dire la structure html de la page -->
<!-- on se met donc du côté client et une fois que la page a été chargée -->
<!-- on lance un slider automatique sur les 2 images du produit -->
<!-- qui cache la deuxième image et attend ensuite 3 secondes pour afficher -->
<!-- la deuxieme image et celà se repete à l'infini -->
<!-- temp d'éxécution du script : 5ms -->
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

<div style="position: relative; bottom:0;padding-top: 50px">
    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once('include/footer.php'); ?>
</div>
