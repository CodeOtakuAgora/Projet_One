<style>
    input[type=email] {
        background-color: lightgrey;
    }

    input[type=email]:focus {
        background-color: #fff;
    }
</style>

<div class="content">
    <div class="container contact-container"
         style="text-align: center; max-width: 40%;">
        <h1>Contactez Moi :</h1>

        <form id="formulaire" method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom et prénom">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre téléphone">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="mail" placeholder="Votre email">
            </div>
            <div class="form-group">
				<textarea class="form-control" rows="5" id="comment" name="message"
                          placeholder="Votre commentaire">
					</textarea>
            </div>

            <div>
                <input type="submit" value="Envoyer" class="envoyer" name="mailform">

            </div>
            <p id="message"></p>
        </form>

        <!-- si il y a un message d'echec ou de réussite à afficher alors affiche le -->
        <?php if (isset($msg)) {
            echo $msg;
        }
        ?>
    </div>
    
    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once("include/footer.php"); ?>

</div>
