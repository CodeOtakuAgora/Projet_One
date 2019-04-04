<?php
    $titleArticles = "Page Article";
    require_once('include/require.php');
    $get_id = htmlspecialchars(Util::getGetParam('id'));
    $article = null;
    $bdArticle = Bdd::getInstance()->conn->prepare('SELECT * FROM produits WHERE id = ?');
    $bdArticle->execute(array($get_id));
    if ($bdArticle->rowCount() == 1) {
        $article = $bdArticle->fetch();
        $logo = $article['logo'];
        $nom = $article['nom'];
        $description = $article['description'];
        $prix = $article['prix'];
    }

?>

<br/><br/><br/><br/><br/>
<?php if ($article) { ?>
    <form align="center" action="panier.php">
        <img src="ressources/vetements/<?php echo $logo ?>" width="100" height="75">
        <h1><?php echo $nom ?></h1>
        <p><?php echo $description ?></p>
        <p><?php echo number_format($prix, 2, '.', '') . ' € ' ?></p><br/>
        <?php if (isset($_SESSION['login'])) {
            ?>
            <a href="panier.php?action=add&id=<?php echo $get_id; ?>">Ajouter au Panier</a>
            <?php
        } else {
            ?><a href="login.php">Ajouter au Panier</a><?php
        } ?>
        <br/><br/>
        <button type="submit"><a style="text-decoration: none;color:black" href="produits.php">RETOUR</a></button>
    </form>
<?php }
    require_once('include/footer.php');
?>
