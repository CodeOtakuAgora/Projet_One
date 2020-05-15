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
                    Categorie</a></div>
            <table border="0" style="width: 500px;" class="tblSaveForm" aria-describedby="mes catégories">
                <tr style="display: none">
                    <th scope="col"></th>
                </tr>
                <tr class="tableheader">
                    <td colspan="2">Edit Categorie</td>
                </tr>

                <tr>

                    <td><label>Nom</label></td>
                    <td><input type="text" name="nom" class="txtField" value="<?php echo $cat->nom; ?>"></td>

                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
        </div>
    </form>

</div>