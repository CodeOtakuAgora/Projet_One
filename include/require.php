<?php
// on active l'affichage des erreurs
ini_set('display_errors', 'on');
// on stocke dans une variable le chemin absolu (complet) du fichier sur lequel on se trouve
// au moment ou cette page est apellé
$base = dirname(__FILE__);
// on inclut le démarrage de la session et qui définit le menu
// si il est connecté en user ou en admin ou si il n'est pas connecté
require_once($base . "/session.php");

// on inclut toutes les class qui contienent toutes les fonctions
// qui s'occupent de faire toutes les requetes nescessaires sur la database
require_once($base . "/class/Bdd.php");
require_once($base . "/class/Util.php");
require_once($base . "/class/Panier.php");
require_once($base . "/class/Categorie.php");
require_once($base . "/class/Produit.php");
require_once($base . "/class/User.php");

// on inclut tout le head du site ainsi que le menu qui est le même qu'importe la page
// sur laquelle on se trouve ce qui nous permet d'avoir un menu dynamique
require_once($base . "/head.php");
require_once($base . "/header.php");

    

