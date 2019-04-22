<?php

    class Panier extends Bdd
    {
        /**
         * @param $idUser
         * @return mixed
         */
        public static function getPanier($idUser)
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM `panier` WHERE `id_user` = "' . $idUser . '"')->fetchObject();
        }

        /**
         * @param $idUser
         * @return mixed
         */
        public static function setPanier($idUser)
        {
            $sql = "INSERT INTO `panier` (id_user) VALUES (?)";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idUser]);
            return Panier::getPanier($idUser);
        }

        /**
         * @param $idPanier
         * @param $idProduit
         * @return mixed
         */
        public static function getPanierProduit($idPanier, $idProduit)
        {
            $req = sprintf('SELECT * FROM `panier_produit` WHERE `id_panier` = "%s" AND `id_produit` = "%s"', $idPanier, $idProduit);
            return Bdd::getInstance()->conn->query($req)->fetchObject();
        }

        /**
         * @param $idPanier
         * @param $idProduit
         */
        public static function createPanierProduit($idPanier, $idProduit)
        {
            $sql = "INSERT INTO `panier_produit` (id_panier, id_produit, quantity) VALUES (?, ?, ?)";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier, $idProduit, 1]);
        }

        /**
         * @param $idPanier
         * @param $idProduit
         * @param $quantity
         */
        public static function updatePanierProduit($idPanier, $idProduit, $quantity)
        {
            $sql = 'UPDATE `panier_produit` SET `quantity` = ? WHERE `id_panier` = ? AND `id_produit` = ?';
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier, $idProduit, $quantity]);
        }

        /**
         * @param $idPanier
         * @return mixed
         */
        public static function getAllProduit($idPanier)
        {
            $req = sprintf('SELECT * FROM `panier_produit` WHERE `id_panier` = "%s"', $idPanier);
            return Bdd::getInstance()->conn->query($req)->fetchAll();
        }

        /**
         * @param $idPanier
         * @param $idProduit
         */
        public static function deleteProduit($idPanier, $idProduit)
        {
            $sql = "DELETE FROM `panier_produit` WHERE id_panier = ? AND id_produit = ?";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier, $idProduit]);
        }

        /**
         * @param $idPanier
         */
        public static function deletePanier($idPanier)
        {
            $sql = "DELETE FROM `panier_produit` WHERE id_panier = ?";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([$idPanier]);
        }
    }
