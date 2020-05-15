<div class="content">

    <div class="pageconnection">
        <div class="container">
            <div class="formulaireconnect">
                <div class="connexion">
                    <h2 style="text-align:center;font-size:24px;">Se Connecter</h2>
                    <form class="logform" action="login.php" id="myform" method="POST" enctype="multipart/form-data">
                        <input name="email" placeholder="Adresse Mail*" type="text" value="" size="30"/>
                        <input name="password" placeholder="Mot de Passe*" type="password" value="" size="30"/>
                        <div class="forgotadminn">
                            <a style="text-align:center;font-family:Roboto;font-size:16px;text-decoration: none;color: #C2C2C2;"
                               href="index.php">Retour à l'Accueil</a>
                            <a style="text-align:center;font-family:Roboto;font-size:16px;text-decoration: none;color: #C2C2C2;"
                               href="adminConnect.php">Espace Admin</a>
                        </div>
                        <input name="bouton" type="submit" id="seconnecter" value="Connexion"
                               onclick="document.forms['myform'].submit();"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once('include/footer.php'); ?>
</div>