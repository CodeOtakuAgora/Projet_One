<?php require_once('require.php');

if (isset($_GET['search']) AND !empty($_GET['search'])) {

    $produits = Bdd::getInstance()->conn->query('SELECT nom,id,logo FROM produits ORDER BY id DESC');
    $search = htmlspecialchars($_GET['search']);
    $produits = Bdd::getInstance()->conn->query('SELECT nom,id,logo FROM produits WHERE nom LIKE "%' . $search . '%" ORDER BY id DESC');
    if ($produits->rowCount() == 0) {
        $produits = Bdd::getInstance()->conn->query('SELECT nom,id,logo FROM produits WHERE CONCAT(nom, description) LIKE "%' . $search . '%" ORDER BY id DESC');
    }
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <?php if(isset($titleAdminIndex) || isset($titleAdminEditUser) || isset($titleAdminAddUser)) { ?>
                <img width="30px" src="../ressources/logo.png" class="d-inline-block align-top" alt="">
            <?php } else { ?> 
                <img width="30px" src="ressources/logo.png" class="d-inline-block align-top" alt="">
            <?php } ?>
            Hwear
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if(isset($titleAdminIndex) || isset($titleAdminEditUser) || isset($titleAdminAddUser)) { ?>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Acceuil<span class="sr-only">(current)</span></a>
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
                        <a class="nav-link" href="index.php">Acceuil<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produits.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    
                    <?php
                    if ($menuuser == true) {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="user.php">Mon Compte</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="panier.php">Panier</a>
                        </li>
                        ';
                    } else if ($menuadmin == true) {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="admin.php">Tableau de bord</a>
                        </li>
                        ';
                    } else {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="login.php">Se connecter</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="register.php">Senregistrer</a>
                        </li>
                        ';
                    } 
                } ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
      </div>
  </nav>

  <?php
  if (isset($_GET['search']) AND !empty($_GET['search'])) { ?>
    <div class="content">
        <?php if ($produits->rowCount() > 0) { ?>
            <div class="row" style="display: flex;justify-content: center;">
                <div class="card" style="width: 18rem;">
                    <?php foreach ($produits as $articleTrouve) { ?>
                        <a style="text-decoration: none;" href="articles.php?id=<?php echo $articleTrouve['id'] ?>">
                            <img class="card-img-top" 
                            src="ressources/vetements/<?php echo $articleTrouve['logo'] ?>"
                            title="<?php echo $articleTrouve['nom'] ?>"
                            width="250px" height="250px">
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <p style="color:red;" align="center">
                <b>Aucun résultat pour : <?php echo $search; ?></b>
            </p>
        <?php } ?>
    </div><hr>
    <?php } ?>