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
    // qui retourne toutes les catégories ou l'id est égale à l'id passé en parametre
    public static function getCat($idCat)
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM `categories` WHERE `id` = "' . $idCat . '"')->fetchObject();
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
    // qui retourne toutes les sous catégorie ou l'id est égale à l'id passé en parametre
    public static function getSousCat($idSousCat)
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM `sous_categories` WHERE `id` = "' . $idSousCat . '"')->fetchObject();
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
    // qui retourne la categorie dont les informations 
    // viennent d'etre mise à jour une fois la requete executé
    public static function updateCat($nom, $id)
    {
        $sql = "UPDATE `categories` SET `nom` = ? WHERE `id` = ?";
        $stmt = Bdd::getInstance()->conn->prepare($sql);
        $stmt->execute([
            $nom,
            $id
        ]);
        return Categorie::getCat($id);
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne la sous categorie dont les informations 
    // viennent d'etre mise à jour une fois la requete executé
    public static function updateSousCat($nom, $idCat, $id)
    {
        $sql = "UPDATE `sous_categories` SET `nom` = ?, `id_categorie` = ?  WHERE `id` = ?";
        $stmt = Bdd::getInstance()->conn->prepare($sql);
        $stmt->execute([
            $nom,
            $idCat,
            $id
        ]);
        return Categorie::getSousCat($id);
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
