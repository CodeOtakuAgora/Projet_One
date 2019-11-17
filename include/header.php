<!-- on inclut notre package (librairie) qui s'occupe de charger -->
<!-- toutes les pages dont on a besoin-->
<?php require_once('require.php');

// on vérifie si l'input type search à été défini
if (isset($_GET['search']) AND !empty($_GET['search'])) {

    // on récupère les infos de la table produits
    $produits = Bdd::getInstance()->conn->query('SELECT nom,id,logo FROM produits ORDER BY id DESC');
    // on stocke dans une variable le mot qui à été rentré dans la barre de recherche
    $search = htmlspecialchars($_GET['search']);

    // on fait une première vérification dans la table en regardant uniquement la colonne nom
    // pour voir si il y a une correspondance avec ce qui à été rentré dans la barre de recherche
    $produits = Bdd::getInstance()->conn->query('SELECT nom,id,logo FROM produits WHERE nom LIKE "%' . $search . '%" ORDER BY id DESC');
    // si on a trouvé aucun produit qui correspond
    if ($produits->rowCount() == 0) {
        // alors on fait une deuxième vérification en regardant la colonne description 
        // afin de vérifier si il y a une correspondance et de pouvoir faire 
        // une recherche beaucoup plus précise
        $produits = Bdd::getInstance()->conn->query('SELECT nom,id,logo FROM produits WHERE CONCAT(nom, description) LIKE "%' . $search . '%" ORDER BY id DESC');
    }
}
?>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <!-- si cette variable à été défini celà signifie que l'on se trouve -->
            <!-- sur l'une des pages du dossier crud il faut donc par conséquent sortir avec ../ -->
            <!-- du dossier crud afin d'être à la racine du projet -->
            <?php if (isset($titleAdminCrud)) { ?>
                <img width="30px" src="../ressources/logo.png" class="d-inline-block align-top" alt="">
            <?php } else { ?>
                <img width="30px" src="ressources/logo.png" class="d-inline-block align-top" alt="">
            <?php } ?>
            Hwear
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- si cette variable à été défini celà signifie que l'on se trouve -->
                <!-- sur l'une des pages du dossier crud il faut donc par conséquent -->
                <!-- sortir avec ../ du dossier crud afin d'être à la racine du projet -->
                <?php if (isset($titleAdminCrud)) { ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Accueil
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../produits.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin.php">Tableau de bord</a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produits.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                    <?php
                    // si menuuser == true celà signifie qu'il est connecté en user
                    // alors on lui affiche un menu qui est en accord avec les pages 
                    // avec lesquelles il a le droit d'accès 
                    if ($menuuser == true) {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="user.php">Mon Compte</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="panier.php">Panier</a>
                        </li>
                        ';
                    }
                    // si menuadmin == true celà signifie qui est connecté en admin
                    // alors on lui affiche un menu qui est en accord avec les pages 
                    // avec lesquelles il a le droit d'accès
                    else if ($menuadmin == true) {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="admin.php">Tableau de bord</a>
                        </li>
                        ';
                    } 
                    // sinon celà signifie qui n'est pas connecté ni en user ni en admin
                    // alors on lui affiche un menu qui est en accord avec les pages 
                    // avec lesquelles il a le droit d'accès
                    // PS : on met un anti slash (\) afin d'echapper l'apostrophe 
                    // afin qu'il puisse être afficher sur le site et qu'il ne soit pas interpreter en php 
                    else {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="login.php">Se connecter</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="register.php">S\'enregistrer</a>
                        </li>
                        ';
                    }
                } ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>


<?php
// si l'input type search à bien été défini
if (isset($_GET['search']) AND !empty($_GET['search'])) { ?>
    <div class="content">
        <!-- si un article ou plus à été trouvé -->
        <?php if ($produits->rowCount() > 0) { ?>
            <div class="row" style="display: flex;justify-content: center;">
                <div class="card" style="width: 18rem;">
                    <!-- on boucle sur chaque produits en l'affectant -->
                    <!-- à chaque tour de boucle à une variable temporaire -->
                    <!-- et on affiche le produit ou les produits qui ont été trouvés -->
                    <?php foreach ($produits as $articleTrouve) {
                        /* si cette variable à été défini celà signifie que l'on se trouve */
                        /* sur l'une des pages du dossier crud il faut donc par conséquent */
                        /* sortir avec ../ du dossier crud afin d'être à la racine du projet */
                        if(!isset($titleAdminCrud)) { ?>
                            <a style="text-decoration: none;" href="articles.php?id=<?php echo $articleTrouve['id'] ?>">
                                <img class="card-img-top"
                                    src="ressources/vetements/<?php echo $articleTrouve['logo'] ?>"
                                    title="<?php echo $articleTrouve['nom'] ?>"
                                    width="250px" height="250px">
                            </a>
                        <?php } else { ?>
                            <a style="text-decoration: none;" href="../articles.php?id=<?php echo $articleTrouve['id'] ?>">
                                <img class="card-img-top"
                                    src="../ressources/vetements/<?php echo $articleTrouve['logo'] ?>"
                                    title="<?php echo $articleTrouve['nom'] ?>"
                                    width="250px" height="250px">
                            </a>
                        
                    <?php } } ?>
                </div>
            </div>
        <?php } else { ?>
            <p style="color:red;" align="center">
                <b>Aucun résultat pour : <?php echo $search; ?></b>
            </p>
        <?php } ?>
    </div>
    <hr>
<?php } ?>
