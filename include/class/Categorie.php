<?php

// class Categorie qui définit toute les charactéristiques d'une categorie avec pleins de fonctions 
// qui le définissent et qui lui sont propres
// récupère et donc à accès à toutes les fonction de sa class mère (Db)
class Categorie extends Bdd
{

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne toutes les categories trier par id
    public static function getAllCategories()
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM categories ORDER BY id')->fetchAll();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne toutes les sous categories trier par id
    public static function getAllSousCategories()
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM sous_categories ORDER BY id')->fetchAll();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne toutes les sous categories trier par categorie
    public static function getSousCategoriesById($id)
    {
        $sql = sprintf('SELECT * FROM sous_categories WHERE id_categorie = %d ORDER BY id', $id);
        return Bdd::getInstance()->conn->query($sql)->fetchAll();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne les categories qui viennent d'etre créer une fois la requete executé
    public static function setCategorie($nom)
    {
        $sql = "INSERT INTO `categories` (nom) VALUES (?)";
        $stmt = Bdd::getInstance()->conn->prepare($sql);
        $stmt->execute([
            $nom
        ]);
        return Categorie::getAllCategories();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne les sous categories qui viennent d'etre créer une fois la requete executé
    public static function setSousCategorie($nom, $categorie)
    {
        $sql = "INSERT INTO `sous_categories` (nom, id_categorie) VALUES (?, ?)";
        $stmt = Bdd::getInstance()->conn->prepare($sql);
        $stmt->execute([
            $nom,
            $categorie
        ]);
        return Categorie::getAllCategories();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne la requete de suppression d'une categorie à partir de l'id 
    // de la categorie qui a ete passe en parametre
    public static function deleteCat($id)
    {
        return Bdd::getInstance()->conn->query('DELETE FROM categories WHERE `id` = "' . $id . '"');
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne la requete de suppression d'une sous categorie à partir de l'id 
    // de la sous categorie qui a ete passe en parametre
    public static function deleteSousCat($id)
    {
        return Bdd::getInstance()->conn->query('DELETE FROM sous_categories WHERE `id` = "' . $id . '"');
    }
}
