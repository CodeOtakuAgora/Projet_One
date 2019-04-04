<?php
    $titleUser = "Page Profil";
    require_once('include/session.php');
    require_once('include/db.php');
    require_once('include/infos.php');
    require_once('include/header.php');


    if (isset($_SESSION['login'])) {
        echo '<br/><br/><br/><br/>';
        echo '
		<div style="display: flex;justify-content: center;">
		<a style="color:red;font-size:25px;"
		href="deconnection.php">SE DECONNECTER</a>
		</div>
		';
    } else {
        echo '<br/><br/><br/><br/>';
        echo '
		<div style="display:flex;justify-content:center;color:red">
		<a style="color:red;font-size:25px;"
		href="login.php">VEUILLEZ VOUS CONNECTER</a>
		</div>
	';
    }

    require_once('include/footer.php');

?>