<?php
    $titleAdminIndex = "Accueil du CRUD";
    require_once("../include/require.php");
    $result = User::getAllUser();

    require_once("views/index.view.php");
    require_once("../include/footer.php");
?>

