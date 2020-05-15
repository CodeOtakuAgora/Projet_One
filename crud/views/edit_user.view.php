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
                <a style="display: block; text-align: right;" href="index.php" class="link">
                    <img alt='List' title='List'
                         src='images/list.png' width='15px' height='15px'/> List
                    User</a></div>
            <table style="width: 500px" border="0" class="tblSaveForm"
                   aria-describedby="mes users">
                <tr style="display: none">
                    <th scope="col"></th>
                </tr>
                <tr class="tableheader">
                    <td colspan="2">Edit User</td>
                </tr>
                <tr>
                    <td><label>Mail</label></td>
                    <td><input type="hidden" name="id" class="txtField" value="<?php echo $user->id; ?>">
                        <input type="text"
                               name="mail"
                               class="txtField"
                               value="<?php echo $user->mail; ?>">
                    </td>
                </tr>
                <td><label>Nom</label></td>
                <td><input type="text" name="nom" class="txtField" value="<?php echo $user->nom; ?>"></td>
                </tr>
                <td><label>Prénom</label></td>
                <td><input type="text" name="prenom" class="txtField" value="<?php echo $user->prenom; ?>">
                </td>
                </tr>
                <td><label>Rue</label></td>
                <td><input type="text" name="rue" class="txtField" value="<?php echo $user->rue; ?>">
                </td>
                </tr>
                <td><label>Code Postal</label></td>
                <td><input type="text" name="code_postal" class="txtField" value="<?php echo $user->code_postal; ?>">
                </td>
                </tr>
                <td><label>Ville</label></td>
                <td><input type="text" name="ville" class="txtField" value="<?php echo $user->ville; ?>">
                </td>
                </tr>
                <td><label>Téléphone</label></td>
                <td><input type="text" name="telephone" class="txtField" value="<?php echo $user->telephone; ?>">
                </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
        </div>
    </form>

</div>