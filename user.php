<?php
    $titleUser = "Page Profil";
    require_once('include/require.php');


    if (isset($_SESSION['login'])) {
        echo ' <div class=""content>
		<div style="display: flex;justify-content: center;">
		<a style="color:red;font-size:25px;"
		href="deconnection.php">SE DECONNECTER</a>
		</div> </div>
		';
    } else {
        echo ' <div class="content">
		<div style="display:flex;justify-content:center;color:red">
		<a style="color:red;font-size:25px;"
		href="login.php">VEUILLEZ VOUS CONNECTER</a>
		</div> </div>
	';
    }

    require_once('include/footer.php');

?>