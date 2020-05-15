<?php

// on vérifie que c'est bien le user qui est connecté
if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {

    // class Produit qui définit toute les charactéristiques d'un panier avec pleins de fonctions 
    // qui le définissent et qui lui sont propres
    // récupère et donc à accès à toutes les fonction de sa class mère (Db)
    class Panier extends Bdd
    {

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne toutes les éléments du panier ou 
        // l'id du panier est égale à l'id passé en parametre
        public static function getPanier($idUser)
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM `panier` WHERE `id_user` = "' . $idUser . '"')->fetchObject();
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne l'ajout de l'id approprier pour l'id du panier 
        // et qui correspond à l'id du user 
        // !!! si jamais cette requete n'a pas fonctionné et le nouveau user n'a pas de panier 
        // allez dans phpmyadmin dans la base de donnée hwear puis dans la table panier 
        // ajoute un panier pour le nouveau user manuellement en vous inspirant 
        // des valeurs des 2 autres users !!! 
        public static function setPanier($idUser)
        {
            $sql = "INSERT INTO `panier` (id_user) VALUES (?)";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idUser]);
            return Panier::getPanier($idUser);
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne le produit qui à été selectionné grace à son id 
        public static function getPanierProduit($idPanier, $idProduit)
        {
            $req = sprintf('SELECT * FROM `panier_produit` WHERE `id_panier` = "%s" AND `id_produit` = "%s"', $idPanier, $idProduit);
            return Bdd::getInstance()->conn->query($req)->fetchObject();
        }

        // fonction publique (visible et utilisable partout dans le projet)
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne le l'id du panier du user actuellement connecte
        public static function getSpecificPanier($idPanier)
        {
            $req = sprintf('SELECT * FROM `panier_produit` WHERE `id_panier` = "%s"', $idPanier);
            return Bdd::getInstance()->conn->query($req)->fetchObject();
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne l'ajout d'un produit dans le panier pour le user 
        // en initialisant la quantité par défaut du produit à 1
        public static function createPanierProduit($idPanier, $idProduit)
        {
            $sql = "INSERT INTO `panier_produit` (id_panier, id_produit, quantity) VALUES (?, ?, ?)";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier, $idProduit, 1]);
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne la nouvelle quantité du produit ajouté dans le panier 
        // qui est prore au user et aussi au produit selectionné
        public static function updatePanierProduit($idPanier, $idProduit, $quantity)
        {
            $sql = 'UPDATE `panier_produit` SET `quantity` = ? WHERE `id_panier` = ? AND `id_produit` = ?';
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$quantity, $idPanier, $idProduit]);
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne tous les produits présents dans le panier et 
        // qui sont propre à l'utilisateur grace à l'id passé en paramettre
        public static function getAllProduit($idPanier)
        {
            $req = sprintf('SELECT * FROM `panier_produit` WHERE `id_panier` = "%s"', $idPanier);
            return Bdd::getInstance()->conn->query($req)->fetchAll();
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne la requete de suppression du produit du panier du user
        public static function deleteProduit($idPanier, $idProduit)
        {
            $sql = "DELETE FROM `panier_produit` WHERE id_panier = ? AND id_produit = ?";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier, $idProduit]);
        }

        // fonction publique (visible et utilisable partout dans le projet) 
        // statique (qui garde la meme signature partout dans le projet)
        // qui retourne la requete de suppression du panier du user
        public static function deletePanier($idPanier)
        {
            $sql = "DELETE FROM `panier_produit` WHERE id_panier = ?";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier]);
        }


    }

}
