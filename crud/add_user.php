<?php

    $titleAdminAddUser = "Ajout du CRUD User";
    require_once("../include/require.php");
    if (count($_POST) > 0) {
        $user = User::setUser($_POST["mail"], $_POST["password"], $_POST["nom"], $_POST["prenom"], $_POST["rue"], $_POST["code_postal"], $_POST["ville"], $_POST["telephone"]);

        if ($user->mail === $_POST["mail"]) {
            $message = "New User Added Successfully";
        } else {
            $message = "Informations Invalides";
        }
    }


    require_once("views/add_user.view.php");
    require_once("../include/footer.php");
?>
