<?php
// on définit notre balise title
$title = "Page Article";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on définit nos variables propre au produit comme son identifiant par exemple
// afin de pouvoir les passer dans l'url pour qu'on ait l'affichage du produit propre
// à l'id qui à été passé dand l'url
$get_id = htmlspecialchars(Util::getGetParam('id'));
$article = null;
$bdArticle = Bdd::getInstance()->conn->prepare('SELECT * FROM produits WHERE id = ?');
$bdArticle->execute(array($get_id));
// si il y a un article
if ($bdArticle->rowCount() == 1) {
	// on passe dans des vairables toutes les infos du produit qui à été selectionné
    $article = $bdArticle->fetch();
    $logo = $article['logo'];
    $logo2 = $article['logo2'];
    $nom = $article['nom'];
    $description = $article['description'];
    $prix = $article['prix'];
}

//on vérifie que l'id à bien été défini
if(isset($_GET['id']) AND !empty($_GET['id'])) {
	// on sécurise le passage de l'id dans l'url
	$getid = htmlspecialchars($_GET['id']);

	// une fois que le formulaire validé et que les inputs ne sont pas vides
	if(isset($_POST['submit_commentaire'])) {
		if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {

	// on récupére dans des variables ce qui à été rentré dans les inputs en sécurisant le contenu 
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$commentaire = htmlspecialchars($_POST['commentaire']);
	
	// on vérifie la longueur de la chaine du pseudo afin de limiter son pseudo à 25 charactères
	if(strlen($pseudo) < 25) {
	// on insert le pseudo et le commentaire dans la base de donnée
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
	// on passe dans des variables les commentaires propre au produit qui à été selectionné
	$commentaires = Bdd::getInstance()->conn->prepare('SELECT * FROM commentaires WHERE id_produit = ? ORDER BY id DESC');
	$commentaires->execute(array($getid)); 
}

// on inclut la vue (partie visible => front) de la page
require_once('views/articles.view.php');

?>