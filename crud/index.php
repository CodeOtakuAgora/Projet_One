<?php
// on définit notre balise title
$titleAdminCrud = "Accueil du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/session.php");
require_once("../include/head.php");
?>

<div class="container site">
    <h1 class="text-logo">
        <a href="../index.php" style="color: inherit">
            <span class="glyphicon glyphicon-cutlery"></span> Burger Code <span
                    class="glyphicon glyphicon-cutlery"></span>
        </a>
    </h1>

    <?php require 'database.php'; ?>

    <div class="container site">
        <?php
        echo '<div class="tab-content">';

        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();

        foreach ($categories as $category) {
            if ($category['id'] == '1') {
                echo '<div class="tab-pane active" id="' . $category['id'] . '">';
            }
            else {
                echo '<div class="tab-pane" id="' . $category['id'] . '">';
            }

            echo '<div class="row slider">';

            $statement = $db->prepare('SELECT * FROM produits WHERE produits.id_categorie = ?');
            $statement->execute(array($category['id']));
            while ($item = $statement->fetch()) {
                echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img style="min-width: 350px; height: 450px; background: none; object-fit: cover" src="../ressources/vetements/' . $item['logo'] . '" alt="...">
                                    <div class="price">' . number_format($item['prix'], 2, '.', '') . ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['nom'] . '</h4>
                                        <p>' . $item['description'] . '</p>
                                        <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                                    </div>
                                </div>
                            </div>';
            }

            echo '</div>
                        </div>';
        }
        Database::disconnect();
        echo '</div>';
        ?>
    </div>

    <h2 class="text-logo">
        <a href="admin.php" style="color: inherit">
            <span class="glyphicon glyphicon-cutlery"></span> Burger Admin <span
                    class="glyphicon glyphicon-cutlery"></span>
        </a>
    </h2>

    <script>
        $(document).ready(function () {

            $('.slider').slick({

                adaptiveHeight: true,
                prevArrow: '<a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>',
                nextArrow: '<a class="next" onclick="plusSlides(1, 0)">&#10095;</a>',
                slidesToShow: 3,
                slidesToScroll: 3,
                autoplay: true,
                autoplaySpeed: 3000,
                cssEase: 'ease-in-out',

                responsive: [
                    {
                        breakpoint: 800,
                        settings: {
                            adaptiveHeight: false,
                            arrows: false,
                        }
                    }
                ]
            });
        });
    </script>

