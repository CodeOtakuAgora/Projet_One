    <?php if ($article) { ?>
        <div class="row" style="display: flex;justify-content: center;">
        <div class="card" style="width: 18rem;">
        <form align="center" action="panier.php">
            <img class="card-img-top" src="ressources/vetements/<?php echo $logo ?>" 
                width="250px" height="250px">
        <div class="card-body">
            <h1 class="card-title"><?php echo $nom ?></h1>
            <p class="card-text"><?php echo $description ?>
            <?php echo " / Prix : " . number_format($prix, 2, '.', '') . ' € ' ?>
            <?php if (isset($_SESSION['login'])) {
                ?>
                <a href="panier.php?action=add&id=<?php echo $get_id; ?>">Ajouter au Panier</a>
                <?php } else {
                ?><a class="btn btn-primary" href="login.php">Ajouter au Panier</a>
                <?php } ?>
        </div>
        </form>
    </div></div>
    <?php }
    require_once('include/footer.php');
    ?>
