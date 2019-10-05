<div class="content">
    <div class="contenupage">
        <div class="container">
            <div class="row">
                <div class="formulaireinscription">
                    <form class="registerr" action="register.php" id="myForm" method="POST"
                          enctype="multipart/form-data">
                        <h1 style="text-align:center;">Inscription</h1>
                        <h2>Paramètres d'inscription</h2>
                        <input name="email" type="text" value="" size="30" placeholder="Adresse Mail"/>
                        <input name="password" type="password" value="" size="30"
                               placeholder="Mot de Passe"/>
                        <input name="confirm" type="password" value="" size="30" placeholder="Confirmation"/>
                        <h2>Coordonnées personnelles</h2>
                        <input name="nom" type="text" value="" size="30" placeholder="Nom*"/>
                        <input name="prenom" type="text" value="" size="30" placeholder="Prénom*"/>
                        <input name="rue" type="text" value="" size="30" placeholder="Adresse*"/>
                        <input name="cp" type="text" value="" size="30"
                               placeholder="Code Postal*"/>
                        <input name="ville" type="text" value="" size="30" placeholder="Ville*"/>
                        <input name="telportable" type="text" value="" size="30" placeholder="Téléphone Portable*"/>
                        <input name="bouton" type="submit" id="sinscrire" value="Valider"
                               onclick="document.forms['myForm'].submit();"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div style="position: relative; bottom:0; padding-top: 50px">
        <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
        <?php require_once('include/footer.php'); ?>
    </div>

</div>

