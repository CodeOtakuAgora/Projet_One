<?php

    class User extends Bdd
    {

        public static function getAllUser()
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM `users` ORDER BY id DESC');
        }

        
        public static function getUser($idUser)
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `id` = "' . $idUser . '"')->fetchObject();
        }

        public static function getUserByMail($mail)
        {
            return Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` = "' . $mail . '"')->fetchObject();
        }

        public static function setUser($mail, $password, $nom, $prenom, $rue, $code_postal, $ville, $telephone)
        {
            $sql = "INSERT INTO `users` (mail, password, nom, prenom, rue, code_postal, ville, telephone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([
                $mail,
                $password,
                $nom,
                $prenom,
                $rue,
                $code_postal,
                $ville,
                $telephone
            ]);
            return User::getUserByMail($mail);
        }

        public static function updateUser($mail, $password, $nom, $prenom, $rue, $code_postal, $ville, $telephone, $id)
        {
            $sql = "UPDATE `users` SET `mail` = ?, `password` = ?, `nom` = ?, `prenom` = ?,`rue` = ?, `code_postal` = ?, `ville` = ?, `telephone` = ? WHERE `id` = ?";
            $stmt = Bdd::getInstance()->conn->prepare($sql);
            $stmt->execute([
                $mail,
                $password,
                $nom,
                $prenom,
                $rue,
                $code_postal,
                $ville,
                $telephone,
                $id
            ]);
            return User::getUserByMail($mail);
        }

        public static function deleteUser($id)
        {
            return Bdd::getInstance()->conn->query('DELETE FROM users WHERE `id` = "' . $id . '"');

        }

    }
