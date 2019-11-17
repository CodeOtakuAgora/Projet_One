<!-- on boucle sur chaque produits en l'affectant -->
<!-- à chaque tour de boucle à une variable temporaire -->
<?php foreach ($requeteSousCategories as $souscategoriesList) {
    // on execute l'affichage des produits en les classant par sous catégories 
    // grace à l'id qui est passé en parametre
    $products->execute(array($souscategoriesList['id']));
?>

    <!-- on boucle sur chaque produits en l'affectant -->
    <!-- à chaque tour de boucle à une variale temporaire -->
    <?php foreach ($products as $productsList) { ?>
        <!-- on incrémente notre compteur afin de pouvoir effectuer des actions -->
        <!-- à un nombre de tour précis afin qu'on ait 3 images maximum affichés sur la meme ligne -->
        <?php $compteur++;
        
        // on vérifie si notre compteur est égale à une certaine valeur 
        // afin d'afficher notre div class row afin qu'on fait un affichage des produits de 3 par 3
        // en utilisant number_format le nombre du prix sera formaté en un nombre décimal
        if ($compteur == 1 || $compteur == 4 || $compteur == 7 || 
            $compteur == 10 || $compteur == 11) { ?>
         <div class="row" style="display: flex;justify-content: center;">
         <?php } ?>
         <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="ressources/vetements/<?php echo $productsList['logo']; ?>" width="250px" height="250px">
            <div class="card-body">
                <h5 class="card-title"><?php echo $productsList['nom']; ?></h5>
                <p class="card-text"> <?php echo $productsList['description']; ?> / Prix :  
                    <?php echo number_format($productsList['prix'], 2, '.', ''); ?> €</p>
                    <a href="articles.php?id=<?php echo $productsList['id'];?>" class="btn btn-primary">Ajouter au panier</a>
                </div>
            </div>

            <!-- on vérifie si notre compteur est égale à une certaine valeur -->
            <!-- afin de fermer notre div class row -->
            <!-- afin qu'on fait un affichage des produits de 3 par 3 -->
            <?php if ($compteur == 3 || $compteur == 6 || $compteur == 9 || 
                $compteur == 10 || $compteur == 11) { ?>
            </div>
        <?php } } } ?>

    <div style="position: relative; bottom:0">
        <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
        <?php require_once("include/footer.php"); ?>
    </div>


