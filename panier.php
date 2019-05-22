<?php

$titlePanier = "Page Panier";
require_once("include/require.php");

if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {

    $action = !empty($_GET['action']) ? $_GET['action'] : 'show';
    $productId = !empty($_GET['id']) ? $_GET['id'] : null;
    $quantity = !empty($_GET['quantity']) ? $_GET['quantity'] : 1;

    $user = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `id` = "' . $_SESSION['login'] . '"')->fetchObject();

    $panier = Panier::getPanier($user->id);
    if (!$panier) {
        $panier = Panier::setPanier($user->id);
    }

    switch ($action) {
        case 'add':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if (!$product) {
                Panier::createPanierProduit($panier->id, $productId);
            } else {
                Panier::updatePanierProduit($panier->id, $productId, $quantity);
            }
            break;
        case 'del':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if ($product) {
                Panier::deleteProduit($panier->id, $productId);
            }
            break;
        case 'sup':
            $product = Panier::getPanierProduit($panier->id, $productId);
            if ($product) {
                Panier::deletePanier($panier->id);
            }
            break;
    }

    if (isset($_REQUEST['validator'])) {
        Panier::updatePanierProduit($panier->id, $productId, $product->quantity + $quantity);
    }

    $produits = Panier::getAllProduit($panier->id);

    $total = 0;
    $compteur = 0;

}

require_once('views/panier.view.php');

?>
