<?php

    $titleAdminEditUser = "Edition du CRUD User";
    require_once("../include/require.php");
    if (count($_POST) > 0) {

        $user = User::updateUser($_POST["mail"], $_POST["password"], $_POST["nom"], $_POST["prenom"], $_POST["rue"], $_POST["code_postal"], $_POST["ville"], $_POST["telephone"], $_POST['id']);

        if ($user->mail === $_POST["mail"]) {
            $message = "Record Modified Successfully";
        } else {
            $message = "Informations Invalides";
        }


    }

    $user = User::getUser($_GET["id"]);


    require_once("views/edit_user.view.php");
    require_once('../include/footer.php');
?>