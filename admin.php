<?php

    $titleAdmin = "Tableau de Bord";

    require_once('include/require.php');

    if (isset($_SESSION['login']) && $_SESSION['login'] == "admin") {

        if (isset($_GET['type']) AND $_GET['type'] == 'users') {
            if (isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
                $approuve = (int)$_GET['approuve'];
                $req = Bdd::getInstance()->conn->prepare('UPDATE users SET approuve = 1 WHERE id = ?');
                $req->execute(array($approuve));
            }
            if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
                $supprime = (int)$_GET['supprime'];
                $req = Bdd::getInstance()->conn->prepare('DELETE FROM users WHERE id = ?');
                $req->execute(array($supprime));
            }
        } elseif (isset($_GET['type']) AND $_GET['type'] == 'produits') {
            if (isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
                $confirme = (int)$_GET['confirme'];
                $req = Bdd::getInstance()->conn->prepare('UPDATE produits SET confirme = 1 WHERE id = ?');
                $req->execute(array($confirme));
            }
            if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
                $supprime = (int)$_GET['supprime'];
                $req = Bdd::getInstance()->conn->prepare('DELETE FROM produits WHERE id = ?');
                $req->execute(array($supprime));
            }
        }
        $users = Bdd::getInstance()->conn->query('SELECT * FROM users WHERE approuve = 0 ORDER BY id DESC');
        $produits = Bdd::getInstance()->conn->query('SELECT * FROM produits WHERE confirme = 0 ORDER BY id DESC');

        function nbclients()
        {
            $request = Bdd::getInstance()->conn->query('SELECT COUNT(*) AS nbclients FROM `users`');
            $nbclients = $request->fetch();
            return $nbclients;
        }

    }
        require_once('views/admin.view.php');
?>
