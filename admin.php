<?php

require_once('include/session.php');
require_once('include/db.php');
require_once('include/infos.php');
require_once('include/header.php');

if (isset($_SESSION['login'])) {
    function nbclients($bdd)
    {
        $request = $bdd->query('SELECT COUNT(*) AS nbclients FROM `users`');
        $nbclients = $request->fetch();
        return $nbclients;
    }

    echo '<br/><br/><br/><br/>';
    echo '
		<div style="display:flex;justify-content:center;">
		<a style="color:red;font-size:25px;" href="deconnection.php">SE DECONNECTER</a>
		</div>
	';;
    echo '<html>
	<body>
	<div class="contenupage">
		<div class="container">
			<div class="row">
			<h1 align="center">Espace administration<h1><br/>
				<div class="paneladmin">
				<p>
				<a href="crud/index.php">Accéder au CRUD des users</a> <br/>
				<a href="addproduct.php">Ajouter un produit</a> </br>
				<a href="gescommande.php">Gerer les commandes en attente</a> </br>
				<a href="gesclient.php">Gerer les comptes clients</a> </br> </br> </br>
				Il y a ';
    $nbclients = nbclients($bdd);
    echo $nbclients['nbclients'], ' clients dans la base.
				</p>
				</div>
			</div>	
		</div>			
	</div>
		</body>';

} else {
    echo '<br/><br/><br/><br/>
		<div style="display:flex;justify-content:center;">
		<a style="color:red;font-size:25px;" href="login.php">
		VEUILLEZ VOUS CONNECTER</a>
		</div>
	';
}

require_once('include/footer.php');

?>