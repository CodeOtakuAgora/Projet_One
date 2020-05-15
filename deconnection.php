<?php
// on démarre la session
session_start();

// si il a une variable de session on la clean puis on détruit sa session
if (isset($_SESSION['login']) && $_SESSION['login'] != "") {
    $_SESSION['login'] = "";
    session_destroy();
}
// puis on le redirige vers la page d'accueil
echo '
	<script type="text/javascript">
		location.href = \'index.php\';
	</script>';
?>