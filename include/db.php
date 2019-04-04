<?php

// Connection à MySQL

// on se connecte à la base de donnée en renseignant
// l'hôte, le nom de la base de donnée, l'encodage, le nom d'utilisateur, le mot de passe
// On affiche les erreur de connection PDO sous la forme d'un tableau
    class Bdd
    {
        private static $_instance = null;

        public $conn = null;

        /**
         * Constructeur de la classe
         */
        private function __construct()
        {
            $this->conn = new PDO('mysql:host=localhost;dbname=hwear;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }

        public static function getInstance()
        {
            if (!static::$_instance) {
                static::$_instance = new Bdd();
            }
            return static::$_instance;
        }

    }
