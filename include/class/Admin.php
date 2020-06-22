<?php

// class User qui définit toute les charactéristiques d'un user avec pleins de fonctions
// qui le définissent et qui lui sont propres
// récupère et donc à accès à toutes les fonction de sa class mère (Bdd)
class Admin extends Bdd
{
    public static function getHashAdminPassword($login) {
        return Bdd::getInstance()->conn->query('SELECT password AS password FROM `admin` WHERE `login` = "' . $login . '"')->fetchObject();
    }

    public static function isItAdminExist($login) {
        return Bdd::getInstance()->conn->query('SELECT COUNT(*) AS res FROM `admin` WHERE `login` = "' . $login . '"')->fetchObject();
    }

    public static function checkAdminInformation($login, $password) {
        return Bdd::getInstance()->conn->query('SELECT * FROM `admin` WHERE `login` = "' . $login . '" AND `password` = "' . $password . '"')->fetchObject();
    }
}