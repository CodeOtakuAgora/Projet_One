<?php require_once('session.php'); ?>
<?php require_once('db.php'); ?>
<?php
if (isset($_GET['search']) AND !empty($_GET['search'])) {

    $produits = $bdd->query('SELECT nom,id,logo FROM produits ORDER BY id DESC');
    $search = htmlspecialchars($_GET['search']);
    $produits = $bdd->query('SELECT nom,id,logo FROM produits WHERE nom LIKE "%' . $search . '%" ORDER BY id DESC');
    if ($produits->rowCount() == 0) {
        $produits = $bdd->query('SELECT nom,id,logo FROM produits WHERE CONCAT(nom, description) LIKE "%' . $search . '%" ORDER BY id DESC');
    }
}
?>


<div class="nav">
    <label for="toggle">&#9776;</label>
    <input type="checkbox" id="toggle"/>
    <div class="menunav">
        <div class="leftnav">
            <div class="logonav">
                <img width="50px" src="ressources/logo.png">
            </div>
            <div class="search">
                <form method="GET" class="search" style="margin:auto;">
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">
                        <img class="icosrch" src="ressources/search.png">
                    </button>
                </form>
            </div>
        </div>
        <div class="txtnav">
            <a href="index.php">Home</a>
            <a href="produits.php">Shop</a>
            <a href="#">Community Shop</a>
            <a href="contact.php">Contact</a>
            <?php
            if ($menuuser == true) {
                echo '
                            <a href="user.php">Mon Compte</a>
                            <a href="#">Panier</a>
                        ';
            } else if ($menuadmin == true) {
                echo '
                            <a href="admin.php">Tableau de Bord</a>
                        ';
            } else {
                echo '<span class="nonlog">
                            <a href="login.php">Login in</a>
                            <a href="register.php"><span class="registerbutton">Register</span></a>
                        </span>
                        ';
            } ?>
        </div>
    </div>
</div>

<?php
if (isset($_GET['search']) AND !empty($_GET['search'])) {
    if ($produits->rowCount() > 0) { ?>
        <br/><br/><br/><br/><br/>
        <div align="center">
            <?php while ($articleTrouve = $produits->fetch()) { ?>
                <a style="text-decoration: none;" href="articles.php?id=<?= $articleTrouve['id'] ?>">
                    <img src="ressources/vetements/<?= $articleTrouve['logo'] ?>" title="<?= $articleTrouve['nom'] ?>"
                         width="80" height="55">
                </a>
            <?php } ?>
        </div>
    <?php } else {
        echo '<br/><br/><br/><br/> Aucun résultat pour : ' . $search;
    }
} ?>

