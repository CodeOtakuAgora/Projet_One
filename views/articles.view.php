    <?php if ($article) { ?>
        <div class="row" style="display: flex;justify-content: center;">
            <div class="card" style="width: 18rem;">
                <form align="center" action="panier.php">
                    <img class="card-img-top" src="ressources/vetements/<?php echo $logo ?>" 
                    width="250px" height="250px">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $nom ?></h1>
                        <p class="card-text"><?php echo $description ?>
                        <?php echo " / Prix : " . number_format($prix, 2, '.', '') . ' € ' ?>
                        <?php if (isset($_SESSION['login'])) {
                            ?>
                            <a href="panier.php?action=add&id=<?php echo $get_id; ?>">Ajouter au Panier</a>
                        <?php } else {
                            ?><a class="btn btn-primary" href="login.php">Ajouter au Panier</a>
                        <?php } ?>
                    </div>
                </form>
            </div></div>

    <?php
        if(isset($_GET['id']) AND !empty($_GET['id'])) {
         $getid = htmlspecialchars($_GET['id']);

         if(isset($_POST['submit_commentaire'])) {
          if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
           $pseudo = htmlspecialchars($_POST['pseudo']);
           $commentaire = htmlspecialchars($_POST['commentaire']);
           if(strlen($pseudo) < 25) {
            $ins = Bdd::getInstance()->conn->prepare('INSERT INTO commentaires (pseudo, message, id_produit) VALUES (?,?,?)');
            $ins->execute(array($pseudo,$commentaire,$getid));
            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
        } else {
            $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
        }
        } else {
            $c_msg = "Erreur: Tous les champs doivent être complétés";
        }
   }
   $commentaires = Bdd::getInstance()->conn->prepare('SELECT * FROM commentaires WHERE id_produit = ? ORDER BY id DESC');
   $commentaires->execute(array($getid));
   ?>

   <h2 align="center">Espace Commentaires :</h2>
   <form method="POST">
         <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo" />
         <textarea class="form-control" rows="3" name="commentaire" placeholder="Votre commentaire..."></textarea>
         <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
    </form>
 <?php if(isset($c_msg)) { echo $c_msg; } ?>
 <?php while($c = $commentaires->fetch()) { ?>
     <p align="center"><b>Pseudo : <?= $c['pseudo'] ?> / Commentaire : <?= $c['message'] ?> / fait le : <?= $c['date_creation']; ?></b></p>
 <?php } } ?>

 <div style="position: relative; bottom:0;padding-top: 50px">
 <?php } require_once('include/footer.php'); ?>
</div>
