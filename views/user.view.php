<div class="content">
    <div style="display: flex;justify-content: center;">
        <a style="color:red;font-size:25px;padding-top: 50px;"
           href="deconnection.php">SE DECONNECTER</a>
    </div>


    <h2 style="font-weight: bold; text-align: center;">Vendre un Produit</h2>
    <div class="container">


        <form method="POST" enctype="multipart/form-data">
            <input name="nom" type="text" placeholder="nom du produit">
            <input name="description" type="text" placeholder="description du produit">
            <input name="prix" step="0.01" type="number" placeholder="prix du produit">
            <input name="logo" type="file" placeholder="logo du produit">
            <input name="logo2" type="file" placeholder="logo2 du produit">
            <select name="category">
                <?php
                // on boucle afin de récupérer toutes les catégories
                // afin de proposer à l'utilisateur de choisir la catégorie de son produit
                foreach (Bdd::getInstance()->conn->query('SELECT * FROM categories') as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                }
                ?>
            </select>
            <select name="souscategory">
                <?php
                // on boucle afin de récupérer toutes les sous catégories
                // afin de proposer à l'utilisateur de choisir la sous catégorie de son produit
                foreach (Bdd::getInstance()->conn->query('SELECT * FROM sous_categories') as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                }
                ?>
            </select>
            <input name="bouton" type="submit" value="Valider">
        </form>
    </div>

    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once('include/footer.php'); ?>

</div>
