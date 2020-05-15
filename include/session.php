<?php

// si l'utilisateur n'est pas connecté, on démarre sa session.
if (!isset($_SESSION['login'])) {

    // on Démarre une nouvelle session ou on reprend une session existante
    // puis on retourne TRUE si une session a pu être démarrée avec succès, et sinon FALSE
    session_start();
}

// on déclare nos variables qui s'occuperont de définir les éléments du menu 
$menuuser = "";
$menuadmin = "";

// si l'utilisateur est loggé et qu'il n'est pas admin, on met la variable menuuser 
// a true pour afficher le menu qui est prore à utilisateur
if (isset($_SESSION['login']) && $_SESSION['login'] != 'admin') {
    $menuuser = true;
}
// sinon si l'utilisateur est loggé et qu'il est admin, on met la variable menuadmin a true 
// pour afficher le menu qui est propre à l'administrateur
elseif (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {
    $menuadmin = true;
}
// si il n'est pas connecté, on met la variable menuuser et menuadmin a false
// pour afficher le menu de base lorsque l'on se rend sur le site pour la première fois
elseif (!isset($_SESSION['login'])) {
    $menuuser = false;
    $menuadmin = false;
}

// si il n'est pas connecté et qu'il essaye d'accéder à la page panier,user 
// qui sont propre à quelqu'un qui est connecté en tant que user à travers l'url 
// alors on le redirige vers la page connection
if (isset($titlePanier) || isset($titleUser) || isset($titleAdmin)) {
    if (!isset($_SESSION['login'])) {
        echo '
	            <script type="text/javascript">
		            location.href = \'login.php\';
	            </script>';
    }
}

// si il n'est pas connecté et qu'il essaye d'accéder aux pages du crud (back office)
// qui sont propre à quelqu'un qui est connecté en tant que admin à travers l'url 
// alors on le redirige vers la page connection
if (isset($titleAdminCrud)) {
    if (!isset($_SESSION['login'])) {
        echo '
                <script type="text/javascript">
                    location.href = \'../login.php\';
                </script>';
    }
}

// si un user qui est connecté essaye d'accéder aux pages du crud (back office) 
// qui sont propre à l'administrateur à travers l'url 
// alors on le redirige vers la page connection
if (isset($titleAdminCrud)) {
    if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {
        echo '
                <script type="text/javascript">
                    location.href = \'../login.php\';
                </script>';
    }
}

// si un user essaye qui est connecté essaye d'accéder à la page admin 
// qui sont propre à l'administrateur à travers l'url 
// alors on le redirige vers la page connection
if (isset($titleAdmin)) {
    if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {
        echo '
	            <script type="text/javascript">
		            location.href = \'login.php\';
	            </script>';
    }
}

// si l'admin essaye d'accéder à la page panier,user 
// qui sont propres au user à travers l'url 
// alors on le redirige vers la page connection
if (isset($titlePanier) || isset($titleUser)) {
    if (isset($_SESSION['login']) && $_SESSION['login'] == "admin") {
        echo '
	            <script type="text/javascript">
		            location.href = \'login.php\';
	            </script>';
    }
}
    
