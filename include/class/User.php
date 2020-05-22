<?php

// class User qui définit toute les charactéristiques d'un user avec pleins de fonctions 
// qui le définissent et qui lui sont propres
// récupère et donc à accès à toutes les fonction de sa class mère (Db)
class User extends Bdd
{

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne tous les users trier par id
    public static function getAllUser()
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM `users` ORDER BY id DESC');
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne tous les users ou l'id est égale à l'id passé en parametre
    public static function getUser($idUser)
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `id` = "' . $idUser . '"')->fetchObject();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne tous les users ou le mail est égale au mail passé en parametre
    public static function getUserByMail($mail)
    {
        return Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` = "' . $mail . '"')->fetchObject();
    }

    public static function getHashPassword($mail) {
        return Bdd::getInstance()->conn->query('SELECT password AS password FROM `users` WHERE `mail` = "' . $mail . '"')->fetchObject();
    }

    public static function isItUserExist($mail) {
        return Bdd::getInstance()->conn->query('SELECT COUNT(*) AS res FROM `users` WHERE `mail` = "' . $mail . '"')->fetchObject();
    }

    public static function checkInformation($mail, $password) {
        return Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` = "' . $mail . '" AND `password` = "' . $password . '"')->fetchObject();
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne le user qui vient d'etre créer une fois la requete executé
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

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne le user dont les informations 
    // viennent d'etre mise à jour une fois la requete executé
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

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne la requete de suppression du user à partir de son id passe en parametre
    public static function deleteUser($id)
    {
        return Bdd::getInstance()->conn->query('DELETE FROM users WHERE `id` = "' . $id . '"');
    }

}
