<style>
    label { display: block;padding: 0 100px 0 0; font-size: 18px; } 
</style>

<div class="content">
    <form name="frmUser" method="post" action="">
        <div style="width:500px;">
            <div class="message"><?php if (isset($message)) {
                    echo $message;
                } ?></div>
            <div align="right" style="padding-bottom:5px;"><a href="index.php" class="link"><img alt='List' title='List'
                 src='images/list.png' width='15px' height='15px'/> List
                    Produits</a></div>
            <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="2">Add New Produits</td>
                </tr>
                <tr>
                    <td><label>Nom</label></td>
                    <td><input type="text" name="nom" class="txtField"></td>
                </tr>
                <tr>
                    <td><label>Description</label></td>
                    <td><input type="text" name="description" class="txtField"></td>
                </tr>
                <td><label>Prix</label></td>
                <td><input type="text" name="prix" class="txtField"></td>
                </tr>
               <tr><td>
                <select name="category">
                <?php
                // on boucle afin de récupérer toutes les catégories 
                // afin de proposer à l'utilisateur de choisir la catégorie de son produit
                foreach (Bdd::getInstance()->conn->query('SELECT * FROM categories') as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';;
                }
                ?>
                </select></td>
                </tr>
                <tr><td>
                        <select name="souscategory">
                        <?php
                        // on boucle afin de récupérer toutes les sous catégories 
                        // afin de proposer à l'utilisateur de choisir la sous catégorie de son produit
                        foreach (Bdd::getInstance()->conn->query('SELECT * FROM sous_categories') as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';;
                        }
                        ?>
                    </select></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
        </div>
    </form>
</div>