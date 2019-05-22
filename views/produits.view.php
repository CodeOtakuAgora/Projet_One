<?php foreach ($requeteSousCategories as $souscategoriesList) {
    $products->execute(array($souscategoriesList['id']));
?>


    <?php foreach ($products as $productsList) { ?>
        <?php $compteur++; 
        if ($compteur == 1 || $compteur == 4 || $compteur == 7) { ?>
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
            <?php if ($compteur == 3 || $compteur == 6 || $compteur == 9) { ?>
            </div>
        <?php } } } ?>

    <div style="position: relative; bottom:0">
        <?php require_once("include/footer.php"); ?>
    </div>


