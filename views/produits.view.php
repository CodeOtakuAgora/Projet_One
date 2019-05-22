<div class="row">


        <?php foreach ($requeteSousCategories as $souscategoriesList) {

    $products->execute(array($souscategoriesList['id']));
    $monProduits = '';

        ?>



        <?php foreach ($products as $productsList) { ?>
        <div class="card" style="width: 18rem;">
            <img style="width=80px;height=50px;" class="card-img-top" src="ressources/vetements/<?php echo $productsList['logo']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $productsList['nom']; ?></h5>
                <p class="card-text"> <?php echo $productsList['description']; ?> / 
                <?php echo number_format($productsList['prix'], 2, '.', ''); ?> €</p>
                <a href="articles.php?id=<?php echo $productsList['id'];?>" class="btn btn-primary">Ajouter au panier</a>
            </div>
        </div>

        <?php } } ?>
</div>
<div style="position: relative; bottom:0">
<?php require_once("include/footer.php"); ?>
</div>