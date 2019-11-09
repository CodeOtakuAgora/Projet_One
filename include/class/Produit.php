<?php

// class Produit qui définit toute les charactéristiques d'un produit avec pleins de fonctions 
// qui le définissent et qui lui sont propres
// récupère et donc à accès à toutes les fonction de sa class mère (Db)
class Produit extends Bdd
{
    
    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne toutes les categories trier par id
    public static function getAllProduits()
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM produits ORDER BY id')->fetchAll();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne tous les users ou l'id est égale à l'id passé en parametre
    public static function getProduit($idProduit)
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM `produits` WHERE `id` = "' . $idProduit . '"')->fetchObject();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne tous les produits disponible à la vente avec la colonne confirme = 1 
    // trier par sa sous catégorie et par son id  
    public static function getProduitsByIdSousCategorie($id)
    {
        $sql = sprintf('SELECT * FROM produits WHERE id_sous_categorie = %d AND confirme = 1 ORDER BY id', $id);
        return Bdd::getInstance()->conn->query($sql)->fetchAll();

    }

     // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne les categories qui viennent d'etre créer une fois la requete executé
    public static function setProduit($nom, $description, $prix, $category, $souscategory) 
    {
        $prix = (float) $prix;
        $sql = "INSERT INTO `produits` (nom, description, prix, id_categorie, id_sous_categorie) VALUES (?, ?, ?, ?, ?)";
        $stmt = Bdd::getInstance()->conn->prepare($sql);
        $stmt->execute([
            $nom,
            $description,
            $prix,
            $category,
            $souscategory
        ]);
        return Produit::getAllProduits();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne le user dont les informations 
    // viennent d'etre mis à jour une fois la requete executé
    public static function updateProduit($nom, $description, $prix, $category, $souscategory, $id)
    {
        $sql = "UPDATE `produits` SET `nom` = ?, `description` = ?, `prix` = ?, `id_categorie` = ?, 
            `id_sous_categorie` = ? WHERE `id` = ?";
        $stmt = Bdd::getInstance()->conn->prepare($sql);
        $stmt->execute([
            $nom,
            $description,
            $prix,
            $category,
            $souscategory,
            $id
        ]);
        return Produit::getProduit($id);
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne la requete de suppression d'un produit à partir de l'id 
    // du produit qui a ete passe en parametre
    public static function deleteProduit($id)
    {
        return Bdd::getInstance()->conn->query('DELETE FROM produits WHERE `id` = "' . $id . '"');
    }
}
