<style>
    label {
        display: block;
        padding: 0 100px 0 0;
        font-size: 18px;
    }

    td  {
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
                    User</a></div>
            <table border="0" style="width: 500px;" class="tblSaveForm" aria-describedby="mes users">
                <tr style="display: none">
                    <th scope="col"></th>
                </tr>
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
</div>