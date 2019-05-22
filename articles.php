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

    require_once('views/articles.view.php');

?>