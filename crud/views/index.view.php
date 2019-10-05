<div align="center" class="content">
    <form name="frmUser" method="post">
        <div style="width:500px;">
            <div class="message"><?php if (isset($message)) {
                    echo $message;
                } ?></div>
            <div align="right" style="padding-bottom:5px;"><a href="add_user.php" class="link"><img alt='Add'
                 title='Add' src='images/add.png' width='15px' height='15px'/> Add
                    User</a></div>
            <table border="0" cellpadding="10" cellspacing="1" width="650"
                   class="tblListForm">
                <tr class="listheader">
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Mail</td>
                    <td>Rue</td>
                    <td>Code Postal</td>
                    <td>Ville</td>
                    <td>Téléphone</td>
                    <td>Actions</td>
                </tr>
                <?php
                    $i = 0;
                    foreach ($result as $row) {
                        if ($i % 2 == 0)
                            $classname = "evenRow";
                        else
                            $classname = "oddRow";
                        ?>
                        <tr class="<?php if (isset($classname)) echo $classname; ?>">
                            <td><?php echo $row["nom"]; ?></td>
                            <td><?php echo $row["prenom"]; ?></td>
                            <td><?php echo $row["mail"]; ?></td>
                            <td><?php echo $row["rue"]; ?></td>
                            <td><?php echo $row["code_postal"]; ?></td>
                            <td><?php echo $row["ville"]; ?></td>
                            <td><?php echo $row["telephone"]; ?></td>
                            <td><a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Edit'
                                 title='Edit' src='images/edit.png' width='15px' height='15px' hspace='10'/></a>
                                <a href="delete_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Delete'
                                   title='Delete' src='images/delete.png' width='15px' height='15px' hspace='10'/></a>
                            </td>
                        </tr>
                        <?php
                        $i++;


                    }
                ?>
            </table></div>

                </form>


        <form name="frmUser" method="post">
        <div style="width:500px;">
            <div class="message"><?php if (isset($message)) {
                    echo $message;
                } ?></div>
            <div align="right" style="padding-bottom:5px;"><a href="add_cat.php" class="link"><img alt='Add'
                 title='Add' src='images/add.png' width='15px' height='15px'/> Add
                    Categorie</a></div>
            <table border="0" cellpadding="10" cellspacing="1" width="650"
                   class="tblListForm">
                <tr class="listheader">
                    <td>id</td>
                    <td>Nom</td>
                    <td>Actions</td>
                </tr>
                <?php
                    $i = 0;
                    foreach ($result2 as $row) {
                        if ($i % 2 == 0)
                            $classname = "evenRow";
                        else
                            $classname = "oddRow";
                        ?>
                        <tr class="<?php if (isset($classname)) echo $classname; ?>">
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nom"]; ?></td>
                            <td><a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Edit'
                                 title='Edit' src='images/edit.png' width='15px' height='15px' hspace='10'/></a>
                                <a href="delete_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Delete'
                                   title='Delete' src='images/delete.png' width='15px' height='15px' hspace='10'/></a>
                            </td>
                        </tr>
                        <?php
                        $i++;


                    }
                ?>
            </table></div> </form>





        <form name="frmUser" method="post">
        <div style="width:500px;">
            <div class="message"><?php if (isset($message)) {
                    echo $message;
                } ?></div>
            <div align="right" style="padding-bottom:5px;"><a href="add_sous_cat.php" class="link"><img alt='Add'
                 title='Add' src='images/add.png' width='15px' height='15px'/> Add
                    Sous Categorie</a></div>
            <table border="0" cellpadding="10" cellspacing="1" width="650"
                   class="tblListForm">
                <tr class="listheader">
                    <td>Nom</td>
                    <td>Catégorie</td>
                    <td>Actions</td>
                </tr>
                <?php
                    $i = 0;
                    foreach ($result3 as $row) {
                        if ($i % 2 == 0)
                            $classname = "evenRow";
                        else
                            $classname = "oddRow";
                        ?>
                        <tr class="<?php if (isset($classname)) echo $classname; ?>">
                            <td><?php echo $row["nom"]; ?></td>
                            <td><?php echo $row["id_categorie"]; ?></td>
                            <td><a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Edit'
                                 title='Edit' src='images/edit.png' width='15px' height='15px' hspace='10'/></a>
                                <a href="delete_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Delete'
                                   title='Delete' src='images/delete.png' width='15px' height='15px' hspace='10'/></a>
                            </td>
                        </tr>
                        <?php
                        $i++;


                    }
                ?>
            </table></div> </form>

    <a href="../admin.php"><h2 style="color: red">RETOUR</h2></a>

</div>


<div style="position: relative; bottom:0">
<?php
// on inclut le footer du site tout à la fin car le but est de le charger en dernier
require_once("../include/footer.php"); 
?>
</div>

