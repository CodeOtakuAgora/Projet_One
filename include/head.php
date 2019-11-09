<!--
==============================================================
============ Bienvenue sur notre code source =================
==============================================================

                    ▌ ▌▌ ▌▛▀▘▞▀▖▛▀▖
                    ▙▄▌▌▖▌▙▄ ▙▄▌▙▄▘
                    ▌ ▌▙▚▌▌  ▌ ▌▌▚ 
                    ▘ ▘▘ ▘▀▀▘▘ ▘▘ ▘

==============================================================
==================== https://hwear.fr/ ==========
==============================================================
-->

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">

    <!-- IMPORT DE BOOTSTRAP POUR LE MENU RESPONSIVE -->
    <!-- afin d'avoir le style de bootstrap dans toutes les pages --> 
    <!-- ainsi que le menu hamburger -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>

    <!-- si l'une des ces 3 variables à été défini celà signifie que l'on se trouve -->
    <!-- sur l'une des pages du dossier crud il faut donc par conséquent sortir avec ../ -->
    <!-- du dossier crud afin d'être à la racine du projet -->
    <?php if (isset($titleAdminIndex) || isset($titleAdminEditUser) || isset($titleAdminAddUser) || 
              isset($titleAdminAddProduit) || isset($titleAdminEditProduit)) { ?>
        <!-- on importe le le favicon ainsi que le logo -->
        <!-- On specifi qu'on charge un certain favicon en fonction de la taille de l'écran -->
        <link rel="apple-touch-icon" sizes="57x57" href="../ressources/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../ressources/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../ressources/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../ressources/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../ressources/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../ressources/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../ressources/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../ressources/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../ressources/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../ressources/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../ressources/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../ressources/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../ressources/favicon/favicon-16x16.png">
        <link rel="manifest" href="../ressources/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../ressources/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link type="text/css" rel="stylesheet" href="../include/style.css">

    <!-- si on ne trouve pas dans dans le crud alors ce sera ce chemin la par défaut -->
    <!-- on importe le le favicon ainsi que le logo -->
    <?php } else { ?>
        <!-- On specifi qu'on charge un certain favicon en fonction de la taille de l'écran -->
        <link rel="apple-touch-icon" sizes="57x57" href="ressources/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="ressources/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="ressources/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="ressources/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="ressources/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="ressources/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="ressources/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="ressources/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="ressources/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="ressources/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="ressources/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="ressources/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ressources/favicon/favicon-16x16.png">
        <link rel="manifest" href="ressources/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ressources/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link type="text/css" rel="stylesheet" href="include/style.css">
    <?php } ?>

    <!-- on defini la configuration pour le site s'adapte -->
    <!-- à la taille d'un ecran de telephone -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- on importe la police de tous nos elements -->
    <link rel="stylesheet" href="https://use.typekit.net/gck5swo.css">

    <!-- IMPORT LIBRAIRIE SWEETALERT -->
    <!-- elle permet de déclencher des animations de reussites et d'echec --> 
    <!-- pour les boites de dialogues -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    
    <!-- on définit le titre de chaque page car en fait chaque page possede une variable -->
    <!-- qui se nomme générallement title  + le titre de la page en camelCase-->
    <!-- qui contient le titre de la page et donc on vérifit si elle est définit -->
    <!-- et si c'est le cas le contenu de cette variable sera alors le contenu de la balise !-- title ce qui nous permet d'avoirun titre dynamique propre à chaque page -->
    <title><?php
        if (isset($titleIndex)) {
            echo $titleIndex;
        } elseif (isset($titleContact)) {
            echo $titleContact;
        } elseif (isset($titleRegister)) {
            echo $titleRegister;
        } elseif (isset($titleLogin)) {
            echo $titleLogin;
        } elseif (isset($titleAdminConnect)) {
            echo $titleAdminConnect;
        } elseif (isset($titleProduits)) {
            echo $titleProduits;
        } elseif (isset($titleArticles)) {
            echo $titleArticles;
        } elseif (isset($titlePanier)) {
            echo $titlePanier;
        } elseif (isset($titleAdmin)) {
            echo $titleAdmin;
        } elseif (isset($titleUser)) {
            echo $titleUser;
        } elseif (isset($titleAdminIndex)) {
            echo $titleAdminIndex;
        } elseif (isset($titleAdminEditUser)) {
            echo $titleAdminEditUser;
        } elseif (isset($titleAdminAddUser)) {
            echo $titleAdminAddUser;
        } elseif (isset($titleAdminAddProduit)) {
            echo $titleAdminAddProduit;
        } elseif ($titleAdminEditProduit) {
            echo $titleAdminEditProduit;
        }
        ?>
    </title>


</head>