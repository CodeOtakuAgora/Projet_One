<?php

require_once('db.php');

$produits = $bdd->query('SELECT nom FROM produits ORDER BY id DESC');
if(isset($_GET['search']) AND !empty($_GET['search'])) {
   $search = htmlspecialchars($_GET['search']);
   $produits = $bdd->query('SELECT nom FROM produits WHERE nom LIKE "%'.$search.'%" ORDER BY id DESC');
   if($produits->rowCount() == 0) {
      $produits = $bdd->query('SELECT nom FROM produits WHERE CONCAT(nom, description) LIKE "%'.$search.'%" ORDER BY id DESC');
   }
}
?>

