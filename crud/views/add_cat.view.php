<div class="content">
    <form name="frmUser" method="post" action="">
        <div style="width:500px;">
            <div class="message"><?php if (isset($message)) {
                    echo $message;
                } ?></div>
            <div align="right" style="padding-bottom:5px;"><a href="index.php" class="link"><img alt='List' title='List'
                 src='images/list.png' width='15px' height='15px'/> List
                    Categorie</a></div>
            <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="2">Add New Categorie</td>
                </tr>
                <tr>
                    <td><label>Nom</label></td>
                    <td><input type="text" name="nom" class="txtField"></td>
                </tr>
                
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
        </div>
    </form>
</div>