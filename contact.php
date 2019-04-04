<!-- on définis notre titre dynamique de la page -->

<?php $titleContact = "Page Contact"; ?>
<?php require_once('include/require.php'); ?>

<style>
    input[type=email] {
        background-color: lightgrey;
    }

    input[type=email]:focus {
        background-color: #fff;
    }
</style>

<div class="content">


    <div class="container"
         style="text-align: center; max-width: 40%;">
        <h1>Contactez Moi :</h1>

        <form id="formulaire" method="post" enctype="text/plain"
              action="mailto:arthur.boutonnet@gmail.com,hfief1806@gmail.com,bastian.peire@gmail.com">
            <div class="form-group">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom et prénom">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre téléphone">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="5" id="comment" name="comment"
                          placeholder="Votre commentaire"></textarea>
            </div>

            <div>
                <input type="submit" value="Envoyer" class="envoyer">
            </div>
            <p id="message"></p>
        </form>
    </div>

</div>

<?php require_once("include/footer.php"); ?>
