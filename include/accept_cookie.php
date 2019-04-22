<?php
    setcookie('cdd', true, time() + 24 * 60 * 60, '/', null, false, true);
    header('location:' . $_SERVER['HTTP_REFERER']);
?>