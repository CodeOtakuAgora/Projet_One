<?php
// si l'utilisateur est connecté, on reprend la session.

    if (!isset($_SESSION['login'])) {

        /*	on Démarre une nouvelle session ou on reprend une session existante
            Puis on Retourne TRUE si une session a pu être démarrée avec succès, et sinon FALSE
        */
        session_start();
    }

    $menuuser = "";
    $menuadmin = "";

    /* si l'utilisateur est loggé et qu'il n'est pas admin, on met menuuser à true pour afficher le menu utilisateur.
    */
    if (isset($_SESSION['login']) && $_SESSION['login'] != 'admin') {
        $menuuser = true;
    } /* sinon si l'utilisateur est loggé et qu'il est admin, on met menuchange à true pour afficher le menu administrateur.
*/
    else if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {
        $menuadmin = true;
    } else if (!isset($_SESSION['login'])) {
        $menuuser = false;
        $menuadmin = false;
    }

    if (isset($titlePanier) || isset($titleUser) || isset($titleAdmin)) {
        if (!isset($_SESSION['login'])) {
            echo '
	            <script type="text/javascript">
		            location.href = \'login.php\';
	            </script>';
        }
    }
    
