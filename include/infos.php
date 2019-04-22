<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/icon" href="ressources/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.typekit.net/gck5swo.css">
    <link type="text/css" rel="stylesheet" href="include/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

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
            }
        ?>
    </title>


</head>