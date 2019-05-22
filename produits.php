<?php
    $titleProduits = "Page Produits";
    require_once('include/require.php');
    
    $requeteCategories = Bdd::getInstance()->conn->query('SELECT * FROM categories ORDER BY id');
    $requeteSubCategories = Bdd::getInstance()->conn->prepare('SELECT * FROM sous_categories WHERE id_categorie = ? ORDER BY id');
    $requeteSousCategories = Bdd::getInstance()->conn->query('SELECT * FROM sous_categories ORDER BY id');
    $products = Bdd::getInstance()->conn->prepare('SELECT * FROM produits WHERE id_sous_categorie = ? AND confirme = 1 ORDER BY id');
    $compteur = 0;
    require_once('views/produits.view.php');