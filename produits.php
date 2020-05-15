<?php

// on définit notre balise title
$title = "Page Produits";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on stocke dans des variables toutes nos requetes sql pour les produits
$requeteCategories = Bdd::getInstance()->conn->query('SELECT * FROM categories ORDER BY id');
$requeteSubCategories = Bdd::getInstance()->conn->prepare('SELECT * FROM sous_categories WHERE id_categorie = ? ORDER BY id');
$requeteSousCategories = Bdd::getInstance()->conn->query('SELECT * FROM sous_categories ORDER BY id');
$products = Bdd::getInstance()->conn->prepare('SELECT * FROM produits WHERE id_sous_categorie = ? AND confirme = 1 ORDER BY id');

// on définit notre compteur pour effectuer des action à un tour spécifique de la boucle
$compteur = 0;

// on inclut la vue (partie visible => front) de la page
require_once('views/produits.view.php');