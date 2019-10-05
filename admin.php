<?php

// on définit notre balise title
$titleAdmin = "Tableau de Bord";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on vérifie que c'est bien l'admin qui est connecté
if (isset($_SESSION['login']) && $_SESSION['login'] == "admin") {

    // si l'admin à clické sur le bouton approuver on met à jour le user 
    // avec le statut approuve = 1 en passant le type user dans l'url et en parametre
    if (isset($_GET['type']) AND $_GET['type'] == 'users') {
        if (isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
            $approuve = (int)$_GET['approuve'];
            $req = Bdd::getInstance()->conn->prepare('UPDATE users SET approuve = 1 WHERE id = ?');
            $req->execute(array($approuve));
        }
    // si l'admin à clické supprimmer on supprime le user selectionné 
    // avec le statut approuve = 0   
    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
        $supprime = (int)$_GET['supprime'];
        $req = Bdd::getInstance()->conn->prepare('DELETE FROM users WHERE id = ?');
        $req->execute(array($supprime));
    }
    // si l'admin à clické sur le bouton confirmer on met à jour le produit 
    // avec le statut confirme = 1 en passant le type produit dans l'url et en parametre
    } elseif (isset($_GET['type']) AND $_GET['type'] == 'produits') {
        if (isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $confirme = (int)$_GET['confirme'];
            $req = Bdd::getInstance()->conn->prepare('UPDATE produits SET confirme = 1 WHERE id = ?');
            $req->execute(array($confirme));
        }
    // si l'admin à clické supprimmer on supprime le produit selectionné 
    // avec le statut confirme = 0   
    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
        $supprime = (int)$_GET['supprime'];
        $req = Bdd::getInstance()->conn->prepare('DELETE FROM produits WHERE id = ?');
        $req->execute(array($supprime));
    }
}
    // on récupère tout les user et produit présents dans la base données 
    // et on les passe dans des variables
    $users = Bdd::getInstance()->conn->query('SELECT * FROM users WHERE approuve = 0 ORDER BY id DESC');
    $produits = Bdd::getInstance()->conn->query('SELECT * FROM produits WHERE confirme = 0 ORDER BY id DESC');

    // fonction qui retourne le nombre de user présents dans la base de données
    function nbclients()
    {
        $request = Bdd::getInstance()->conn->query('SELECT COUNT(*) AS nbclients FROM `users`');
        $nbclients = $request->fetch();
        return $nbclients;
    }

}

// on inclut la vue (partie visible => front) de la page
require_once('views/admin.view.php');
?>
