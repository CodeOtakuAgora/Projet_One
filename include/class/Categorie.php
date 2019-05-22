<?php

    class Categorie extends Bdd
    {

        public static function getAllCategories()
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM categories ORDER BY id')->fetchAll();
        }

        public static function getAllSousCategories()
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM sous_categories ORDER BY id')->fetchAll();
        }

        public static function getSousCategoriesById($id)
        {
            $sql = sprintf('SELECT * FROM sous_categories WHERE id_categorie = %d ORDER BY id', $id);
            return Bdd::getInstance()->conn->query($sql)->fetchAll();
        }
    }
