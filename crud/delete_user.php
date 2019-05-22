<?php
    require_once("../include/require.php");
    User::deleteUser($_GET["id"]);
    header("Location:index.php");
?>