<?php
if(count($_POST)>0) {
    require_once("db.php");
    $sql = "INSERT INTO users (mail, password, nom, prenom, rue, code_postal, ville, telephone) 
	VALUES ('" . $_POST["mail"] . "','" . $_POST["password"] . "','" . $_POST["nom"] . "','" . $_POST["prenom"] . "','" . $_POST["rue"] ."','" . $_POST["code_postal"] ."','" . $_POST["ville"] ."','" . $_POST["telephone"] ."')";

    mysqli_query($conn,$sql);
    $current_id = mysqli_insert_id($conn);
    if(!empty($current_id)) {
        $message = "New User Added Successfully";
    }
}
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
                        <td colspan="2">Add New User</td>
                    </tr>
                    <tr>
                        <td><label>Mail</label></td>
                        <td><input type="text" name="mail" class="txtField"></td>
                    </tr>
                    <tr>
                        <td><label>Password</label></td>
                        <td><input type="password" name="password" class="txtField"></td>
                    </tr>
                    <td><label>First Name</label></td>
                    <td><input type="text" name="nom" class="txtField"></td>
                    </tr>
                <td><label>Last Name</label></td>
                <td><input type="text" name="prenom" class="txtField"></td>
                </tr>
            <td><label>Rue</label></td>
            <td><input type="text" name="rue" class="txtField"></td>
            </tr>
        <td><label>Code Postal</label></td>
        <td><input type="text" name="code_postal" class="txtField"></td>
        </tr>
    <td><label>Ville</label></td>
    <td><input type="text" name="ville" class="txtField"></td>
    </tr>
<td><label>Téléphone</label></td>
<td><input type="text" name="telephone" class="txtField"></td>
</tr>
<tr>
    <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>