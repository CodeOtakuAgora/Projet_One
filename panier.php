<?php

// on définit notre balise title
$titlePanier = "Page Panier";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages 
// dont on a besoin
require_once("include/require.php");

// on vérifie que c'est bien le user qui est connecté
if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {

    // on passe dans cette variable l'action qui est passé dans l'url
    // on nettoie l'url si il y a déjà une action définit
    $action = !empty($_GET['action']) ? $_GET['action'] : 'show';
    // on recupere l'identifiant du produit passe en parametre
    $productId = !empty($_GET['id']) ? $_GET['id'] : null;
    // on recupere la quantite du produit passe en parametre
    $quantity = !empty($_GET['quantity']) ? $_GET['quantity'] : 1;

    // on récupère l'id du user afin d'avoir un panier propre à l'utilisateur
    $user = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `id` = "' . $_SESSION['login'] . '"')->fetchObject();

    // on lui affiche son panier si il en a déjà sinon on lui on crée un
    // on apelle la fonction getPanier qui appartient à la classe Panier 
    // en lui passant en paramettre l'id du panier qui est égale à l'id du user
    $panier = Panier::getPanier($user->id);
    if (!$panier) {
        $panier = Panier::setPanier($user->id);
    }

    // on vérifie quelle action à été défnit et pour chaque cas passé dans l'url
    // on apelle la fonction qui lui est approprié qui appartiennent 
    // à la classe Panier en lui passant en paramettre ce dont la fonction à besoin
    // tout en vérifiant si il y a bien un produit dans le panier afin 
    // d'eviter d'effectuer la fonction dans le vide 

    // on utilise les switch afin de nous simplifier la tache celà fait la meme chose qu'un if
    // pour le case 'add' par exemple
    // donc ce qu'on fait ce qu'on check le contenu de la variable $action 
    // et on apelle des actions specifiques en fonctions de l'action defini
    switch ($action) {
        // si ce cas est defini dans l'url cela veut dire 
        // qu'un produit a ete ajoute au panier
        // on apelle alors les fonctions permettant d'effectuer cette action 
        // en lui passant les bons paramettre
        case 'add':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if (!$product) {
                Panier::createPanierProduit($panier->id, $productId);
            } else {
                Panier::updatePanierProduit($panier->id, $productId, $quantity);
            }
            break;
        // si ce cas est defini dans l'url cela veut dire que un article 
        // a ete retire du panier
        // on apelle alors les fonctions permettant d'effectuer cette action 
        case 'del':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if ($product) {
                Panier::deleteProduit($panier->id, $productId);
            }
            break;
        // si ce cas est defini dans l'url cela veut dire que le panier vie  d'etre vider
        // on apelle alors les fonctions permettant d'effectuer cette action 
        case 'sup':
            $product = Panier::getSpecificPanier($panier->id);
            if ($product) {
                Panier::deletePanier($panier->id);
            }
            break;
        default:
            break;
    }

    // on vérifie si le user modfie la quantité 
    if (isset($_REQUEST['validator'])) {
        // on apelle la fonction updatePanierProduit qui appartient à la classe Panier 
        // en lui passant en paramettre l'id du panier et du produit 
        // ainsi que la quantité du produit selectionné par le user
        Panier::updatePanierProduit($panier->id, $productId, $product->quantity + $quantity);
    }

    // on apelle la fonction getAllProduit qui appartient à la classe Panier 
    // en lui passant en paramettre l'id du panier qui est égale à l'id du user
    $produits = Panier::getAllProduit($panier->id);

    // on définit le prix total de tous les produits presents dans le panier
    // puis on notre compteur pour effectuer des action à un tour spécifique de la boucle
    $total = 0;

}

// on inclut la vue (partie visible => front) de la page
require_once('views/panier.view.php');

?>
