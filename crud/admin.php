<?php
// on définit notre balise title
$titleAdminCrud = "Admin du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/session.php");
require_once("../include/head.php");
?>

<style> .table > tbody > tr > td {
        text-align: center;
        padding-top: 15px;
    } </style>
<h1 class="text-logo">
    <a href="index.php" style="color: inherit">
        <span class="glyphicon glyphicon-cutlery"></span> Burger Code <span class="glyphicon glyphicon-cutlery"></span>
    </a>
</h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span
                        class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
        <table class="table table-striped table-bordered" aria-describedby="liste produits" style="margin-top: 30px;">
            <thead>
            <tr>
                <th scope="col">Images</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require 'database.php';
            $db = Database::connect();
            $statement = $db->query('SELECT produits.id, produits.nom, produits.description, produits.prix, produits.logo, categories.nom AS category FROM produits LEFT JOIN categories ON produits.id_categorie = categories.id ORDER BY produits.id ASC');
            while ($item = $statement->fetch()) {
                echo '<tr>';
                echo '<td><img class="totoImg" width="50px" height="50px" src="../ressources/vetements/' . $item['logo'] . '"></td>';
                echo '<td>' . $item['nom'] . '</td>';
                echo '<td>' . $item['description'] . '</td>';
                echo '<td>' . number_format($item['prix'], 2, '.', '') . '</td>';
                echo '<td>' . $item['category'] . '</td>';
                echo '<td width=300>';
                echo '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                echo ' ';
                echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    let toto = document.getElementsByTagName('td').length;
    for (i = 0; i < toto; i++) {
        let tuax = document.getElementsByTagName('td')[i].children.length;
        if (tuax > 0) {
            let tax = document.getElementsByTagName('td')[i].children[0].classList[0];
            if (tax == 'totoImg') {
                let res = document.getElementsByTagName('td')[i]
                res.style.padding = "5px 8px 8px 8px";
                console.log(document.getElementsByTagName('td')[i]);
            }
        }
    }
</script>
