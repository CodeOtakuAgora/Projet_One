<div class="content">
    <div class="contenupage">
        <div class="container">
            <div class="row formulaireconnect">
                <table width="100%">
                    <thead>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="connexion">
                                <h1>Administraion</h1>
                                <form action="" id="myform" method="POST" enctype="multipart/form-data">
                                    <p>Login:</p>
                                    <input name="login" type="text" value="" size="30"/>
                                    <p>Password:</p>
                                    <input name="password" type="password" value="" size="30"/>
                                    <input name="bouton" type="submit" id="seconnecter" value="Connexion"
                                           onclick="document.forms[\'myform\'].submit();"/>
                                </form>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once('include/footer.php'); ?>

</div>
