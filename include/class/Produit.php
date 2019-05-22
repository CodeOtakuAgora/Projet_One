<?php

    class Produit extends Bdd
    {
        public static function getProduitsByIdSousCategorie($id)
        {
            $sql = sprintf('SELECT * FROM produits WHERE id_sous_categorie = %d AND confirme = 1 ORDER BY id', $id);
            return Bdd::getInstance()->conn->query($sql)->fetchAll();

        }
    }
