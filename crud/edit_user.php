<?php
require_once("db.php");
if(count($_POST)>0) {
    $sql = "UPDATE users set mail='" . $_POST["mail"] . "', 
	password='" . $_POST["password"] . "', 
	nom='" . $_POST["nom"] . "', 
	prenom='" . $_POST["prenom"] . "', 
	rue='" . $_POST["rue"] . "', 
	code_postal='" . $_POST["code_postal"] . "', 
	ville='" . $_POST["ville"] . "', 
	telephone='" . $_POST["telephone"] . "' 
	WHERE id='" . $_POST["id"] . "'";
    mysqli_query($conn,$sql);
    $message = "Record Modified Successfully";
}
$select_query = "SELECT * FROM users WHERE id='" . $_GET["id"] . "'";
$result = mysqli_query($conn,$select_query);
$row = mysqli_fetch_array($result);
?><pre><?php print_r($row);?></pre><?php

?>
<html>
    <head>
        <title>Add New User</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <form name="frmUser" method="post" action="">
            <div style="width:500px;">
                <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                <div align="right" style="padding-bottom:5px;"><a href="index.php" class="link"><img alt='List' title='List' src='images/list.png' width='15px' height='15px'/> List User</a></div>
                <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                    <tr class="tableheader">
                        <td colspan="2">Edit User</td>
                    </tr>
                    <tr>
                        <td><label>Mail</label></td>
                        <td><input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>"><input type="text" name="mail" class="txtField" value="<?php echo $row['mail']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label>Password</label></td>
                        <td><input type="password" name="password" class="txtField" value="<?php echo $row['password']; ?>"></td>
                    </tr>
                    <td><label>Prénom</label></td>
                    <td><input type="text" name="nom" class="txtField" value="<?php echo $row['prenom']; ?>"></td>
                    </tr>
                <td><label>Nom</label></td>
                <td><input type="text" name="prenom" class="txtField" value="<?php echo $row['nom']; ?>">
                </td>
                </tr>
            <td><label>Rue</label></td>
            <td><input type="text" name="rue" class="txtField" value="<?php echo $row['rue']; ?>">
            </td>
            </tr>
        <td><label>Code Postal</label></td>
        <td><input type="text" name="code_postal" class="txtField" value="<?php echo $row['code_postal']; ?>">
        </td>
        </tr>
    <td><label>Ville</label></td>
    <td><input type="text" name="ville" class="txtField" value="<?php echo $row['ville']; ?>">
    </td>
    </tr>
<td><label>Téléphone</label></td>
<td><input type="text" name="telephone" class="txtField" value="<?php echo $row['telephone']; ?>">
</td>
</tr>
<tr>
    <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>