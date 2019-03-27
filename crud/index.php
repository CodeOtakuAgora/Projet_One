<?php
require_once("db.php");
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn,$sql);
?>
<html>  
    <head>
        <title>Users List</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <form name="frmUser" method="post" action="">
            <div style="width:500px;">
                <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                <div align="right" style="padding-bottom:5px;"><a href="add_user.php" class="link"><img alt='Add' title='Add' src='images/add.png' width='15px' height='15px'/> Add User</a></div>
                <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
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
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                        if($i%2==0)
                            $classname="evenRow";
                        else
                            $classname="oddRow";
                    ?>
                    <tr class="<?php if(isset($classname)) echo $classname;?>">
                        <td><?php echo $row["nom"]; ?></td>
                        <td><?php echo $row["prenom"]; ?></td>
                        <td><?php echo $row["mail"]; ?></td>
                        <td><?php echo $row["rue"]; ?></td>
                        <td><?php echo $row["code_postal"]; ?></td>
                        <td><?php echo $row["ville"]; ?></td>
                        <td><?php echo $row["telephone"]; ?></td>
                        <td><a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="link"><img alt='Edit' title='Edit' src='images/edit.png' width='15px' height='15px' hspace='10' /></a>  <a href="delete_user.php?id=<?php echo $row["id"]; ?>"  class="link"><img alt='Delete' title='Delete' src='images/delete.png' width='15px' height='15px'hspace='10' /></a></td>
                    </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </table>
                </form>
            </div>
        <?php
        $result = mysqli_query($conn,$sql);
        echo "Liste Noms : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['nom'];
            echo "\t";
        }
        echo "<br/>";

        $result = mysqli_query($conn,$sql);
        echo "Liste Prénom : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['prenom'];
            echo "\t";
        }
        echo "<br/>";
        $result = mysqli_query($conn,$sql);
        echo "Liste Mails : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['mail'];
            echo "\t";
        }
        echo "<br/>";

        $result = mysqli_query($conn,$sql);
        echo "Liste Rue : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['rue'];
            echo "\t";
        }
        echo "<br/>";

        $result = mysqli_query($conn,$sql);
        echo "Liste Code Postal : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['code_postal'];
            echo "\t";
        }

        echo "<br/>";

        $result = mysqli_query($conn,$sql);
        echo "Listes Villes : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['ville'];
            echo "\t";
        }

        echo "<br/>";

        $result = mysqli_query($conn,$sql);
        echo "Liste téléphones : ";
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['telephone'];
            echo "\t";
        }
        echo'<br/><br/><a href="../admin.php">RETOUR</a>';
        ?>
    </body></html>