<div class="content">
    <div style="display:flex;justify-content:center;padding-top: 50px;">
        <a style="color:red;font-size:25px;" href="deconnection.php">SE DECONNECTER</a>
    </div>

    <div class="contenupage">
        <div class="container">
            <div class="row">
                <h1 align="center">Espace administration
                    <div>
                    </div>
                    <div class="paneladmin">
                        <h3><a href="crud/index.php">Accéder au CRUD des users</a></h3>

                        <p>
                            Il y a
                            <?php $nbclients = nbclients();
                            echo $nbclients['nbclients']; ?> clients dans la base.
                        </p>
                    </div>
            </div>
        </div>
    </div>

    <table align="center" border="10px">
        <tr>


            <?php foreach ($users as $m) { ?>
                <td><p align="center"><?php echo $m['id'] ?> : <?php echo $m['nom'] ?> (<?php echo $m['mail'] ?>
                        )<?php if ($m['approuve'] == 0) { ?> - <a
                                href="admin.php?type=users&approuve=<?php echo $m['id'] ?>">Confirmer</a><?php } ?> - <a
                                href="admin.php?type=users&supprime=<?php echo $m['id'] ?>">Supprimer</a></p></td>
            <?php } ?>

        </tr>

        <tr>


            <?php foreach ($produits as $c) { ?>
                <td><p>
                        <img src="ressources/vetements/<?php echo $c['logo']; ?>" width="50" height="25">
                        : <b><?php echo $c['nom'] ?></b>
                        : <?php echo $c['description'] ?> (<?php echo number_format($c['prix'], 2, '.', '') . ' € ' ?>
                        )<?php if ($c['confirme'] == 0) { ?> - <a
                                href="admin.php?type=produits&confirme=<?php echo $c['id'] ?>">Approuver</a><?php } ?> -
                        <a
                                href="admin.php?type=produits&supprime=<?php echo $c['id'] ?>">Supprimer</a></p></td>
            <?php } ?>

        </tr>


        <?php require_once("include/footer.php"); ?>

</div>