<?php

// class Bdd qui s'occupe de se connecter à la base de donnée
// en définissant l'instance de notre base de donnée et en la vérifant
// afin d'éviter de rédéfinir une nouvelle connection
class Bdd
{
    // on définit la connection et l'instance de base à null
    private static $_instance = null;
    public $conn = null;

    // fonction privé (visible et utilisable uniquement dans la classe Bdd)
    // qui retourne rien (procédure) car c'est le constructeur de la classe mère (Bdd)
    // qui est envoyé à toutes ses classes filles (User,Panier,Categorie,Produit)
    // Constructeur pour instencier notre variable d'instance conn
    private function __construct()
    {
        // Connection à MySQL : on se connecte à la base de donnée en renseignant
        // l'hôte (localhost),
        // le nom de la base de donnée (hwear),
        // l'encodage (utf8),
        // le nom d'utilisateur (root),
        // le mot de passe ()

        // On active les erreurs PDO puis on affiche
        // les erreur de connection PDO sous la forme d'un tableau
        $this->conn = new PDO('mysql:host=localhost;dbname=hwear;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    // fonction publique (visible et utilisable partout dans le projet)
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne l'instance ($_instance) de base de donnée et crée une nouvelle
    // connection si l'instance ($_instance) n'est pas défini n'est pas défini
    public static function getInstance()
    {
        if (!static::$_instance) {
            static::$_instance = new Bdd();
        }
        return static::$_instance;
    }
}