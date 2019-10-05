<?php

// class Produit qui définit toute les charactéristiques d'un produit avec pleins de fonctions 
// qui le définissent et qui lui sont propres
// récupère et donc à accès à toutes les fonction de sa class mère (Db)
class Produit extends Bdd
{
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
    // qui retourne la requete de suppression d'un produit à partir de l'id 
    // du produit qui a ete passe en parametre
    public static function deleteProduit($idProduit)
    {
        return Bdd::getInstance()->conn->query('DELETE FROM produits WHERE id = "%s"',$idProduit);
    }
}
