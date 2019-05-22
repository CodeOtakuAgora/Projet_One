<?php
    $base = dirname(__FILE__);

    if (isset($titleAdminIndex) || isset($titleAdminEditUser) || isset($titleAdminAddUser)) {

        //require_once($base . "../config.php");
        require_once($base . "../session.php");
       
        require_once($base . "../class/db.php");
        require_once($base . "../class/Util.php");
        require_once($base . "../class/Panier.php");
        require_once($base . "../class/Produit.php");
        require_once($base . "../class/Categorie.php");
        require_once($base . "../class/User.php");

        require_once($base . "../head.php");
        require_once($base . "../header.php");

    } else {

        //require_once($base . "/config.php");
        require_once($base . "/session.php");
        
        require_once($base . "/class/db.php");
        require_once($base . "/class/Util.php");
        require_once($base . "/class/Panier.php");
        require_once($base . "/class/Categorie.php");
        require_once($base . "/class/Produit.php");
        require_once($base . "/class/User.php");

        require_once($base . "/head.php");
        require_once($base . "/header.php");
    }

    

