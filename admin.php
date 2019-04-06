<?php

    $titleAdmin = "Tableau de Bord";

    require_once('include/require.php');

    if (isset($_SESSION['login'])) {
        function nbclients()
        {
            $request = Bdd::getInstance()->conn->query('SELECT COUNT(*) AS nbclients FROM `users`');
            $nbclients = $request->fetch();
            return $nbclients;
        }

        echo ' <div class=""content">
		<div style="display:flex;justify-content:center;">
		<a style="color:red;font-size:25px;" href="deconnection.php">SE DECONNECTER</a>
		</div>
	';
        echo
        '<div class="content">
            <div class="contenupage">
		        <div class="container">
			        <div class="row">
			            <h1 align="center">Espace administration<div>
			            </div>
				            <div class="paneladmin">
				                <h3><a href="crud/index.php">Accéder au CRUD des users</a> </h3>
				
				                    Il y a ';
        $nbclients = nbclients();
        echo $nbclients['nbclients'], ' clients dans la base.
				</p>
				</div>
			</div>	
		</div>			
	</div>
		</div>';

    } else {
        echo '<div class="content">
		<div style="display:flex;justify-content:center;">
		<a style="color:red;font-size:25px;" href="login.php">
		VEUILLEZ VOUS CONNECTER</a>
		</div> </div> </div>
	';
    }

    require_once("include/footer.php");
?>