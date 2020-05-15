<style>
    label {
        display: block;
        padding: 0 100px 0 0;
        font-size: 18px;
    }

    td {
        padding: 10px;
    }
</style>

<div class="content">

    <form name="frmUser" method="post" action="">
        <div style="width:500px;">
            <div class="message"><?php if (isset($message)) {
                    echo $message;
                } ?></div>
            <div style="padding-bottom:5px;">
                <a style="display: block; text-align: right" href="index.php" class="link">
                    <img alt='List' title='List'
                         src='images/list.png' width='15px' height='15px'/> List
                    Produit</a></div>
            <table border="0" style="width: 500px;" class="tblSaveForm" aria-describedby="mes produits">
                <tr style="display: none">
                    <th scope="col"></th>
                </tr>
                <tr class="tableheader">
                    <td colspan="2">Edit Produit</td>
                </tr>

                <tr>

                    <td><label>Nom</label></td>
                    <td><input type="text" name="nom" class="txtField" value="<?php echo $prod->nom; ?>"></td>

                </tr>

                <tr>

                    <td><label>Description</label></td>
                    <td><input type="text" name="description" class="txtField"
                               value="<?php echo $prod->description; ?>"></td>

                </tr>

                <tr>

                    <td><label>Prix</label></td>
                    <td><input type="text" name="prix" class="txtField" value="<?php echo $prod->prix; ?>"></td>

                </tr>

                <tr>
                    <td>
                        <select name="category">
                            <?php
                            // on boucle afin de récupérer toutes les catégories
                            // afin de proposer à l'utilisateur de choisir la catégorie de son produit
                            foreach (Bdd::getInstance()->conn->query('SELECT * FROM categories') as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                            }
                            ?>
                        </select></td>
                </tr>

                <tr>
                    <td>
                        <select name="souscategory">
                            <?php
                            // on boucle afin de récupérer toutes les sous catégories
                            // afin de proposer à l'utilisateur de choisir la sous catégorie de son produit
                            foreach (Bdd::getInstance()->conn->query('SELECT * FROM sous_categories') as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
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