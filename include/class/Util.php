<?php

// class Util qui s'occupe de nettoyer l'url si besoin 
// utile si une action est déjà défini et qu'on cherche à en définir une autre 
class Util
{
    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne les action dans l'url et nettoie l'url 
    // si une nouvelle action en methode GET est défini
    public static function getGetParam($param)
    {
        if (!empty($_GET[$param]) && $_GET[$param] !== '') {
            return $_GET[$param];
        }
        return '';
    }

    // fonction publique (visible et utilisable partout dans le projet) 
    // statique (qui garde la meme signature partout dans le projet)
    // qui retourne les action dans l'url et nettoie l'url 
    // si une nouvelle action en methode POST est défini
    public static function getPostParam($param)
    {
        if (!empty($_POST[$param]) && $_POST[$param] !== '') {
            return $_POST[$param];
        }
        return '';
    }
}