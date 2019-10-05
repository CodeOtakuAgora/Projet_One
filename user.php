<?php
// on définit notre balise title
$titleUser = "Page Profil";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on vérifie que c'est bien le user qui est connecté
if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {

    // fonction qui retourne le nombre de users en sécurisant les données
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // on définit le chemin du dossier pour stocker l'image 
    $image = '';
    $imagePath = '';
    $imageExtension = '';
    if (isset($_POST['bouton'])) {
        $image = checkInput($_FILES["logo"]["name"]);
        $imagePath = 'ressources/vetements/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    }

    if ($image != '') 
    {
        // on vérifie l'extension,taille,nom du fichier envoyé
        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $erreur = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $erreur = "Le fichier existe deja";
            $isUploadSuccess = false;
        }

        if (!empty($_FILES["logo"]) && $_FILES["logo"]["size"] > 500000) {
            $erreur = "Le fichier ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }
        // on vérifie si le fichier à bien été déplacé dans le chemin spécifié
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["logo"]["tmp_name"], $imagePath)) {
                $erreur = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }  

    // on check l'input pour le nom, description, prix, logo
    // si il y une erreur on affecte le problème dans le variable d'erreur
    if (!isset($_REQUEST['nom']) || trim($_REQUEST['nom']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le nom est manquant";
        } else {
            $erreur = "Le nom est manquant";
        }
    }
    if (!isset($_REQUEST['description']) || trim($_REQUEST['description']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n La description est manquante";
        } else {
            $erreur = "La description est manquante";
        }
    }

    if (!isset($_REQUEST['prix']) || trim($_REQUEST['prix']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le prix est manquant";
        } else {
            $erreur = "Le prix est manquant";
        }
    }
    if (!isset($_REQUEST['logo']) || trim($_REQUEST['logo']) === '') {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le logo est manquant";
        } else {
            $erreur = "Le logo est manquant";
        }
    }


    // si il n'y a pas d'erreur et que le formulaire a été validé 
    if (!isset($erreur) && isset($_POST['bouton'])) {
        // on passe dans des variables les valeurs rentré dand les input
        $nom = '\'' . $_REQUEST['nom'] . '\'';
        $description = '\'' . $_REQUEST['description'] . '\'';
        $prix = '\'' . $_REQUEST['prix'] . '\'';
        $logo = '\'' . basename($image) . '\'';
        $category = '\'' . $_REQUEST['category'] . '\'';
        $souscategory = '\'' . $_REQUEST['souscategory'] . '\'';
        $id_admin = 1;
        $confirme = 0;



        // on éxecute l'insert des données pour l'ajout du produit avec confirme = 0
        // pour info un produit avec le champ confirme = 0 n'est pas encore disponible
        // à la vente, car il faut que l'admin passe cette valeur à 1
        Bdd::getInstance()->conn->exec('INSERT INTO produits (nom,description,prix,logo,id_categorie,id_sous_categorie,id_admin,confirme) 
    VALUES (' . $nom . ',' . $description . ',' . $prix . ',' . $logo . ',' . $category . ',' . $souscategory . ',' . $id_admin . ',' . $confirme . ')');

        //On teste si le produit à bien été inséré
        $result = Bdd::getInstance()->conn->query('SELECT * FROM `produits` WHERE `nom` LIKE "' . $nom . '"');
        ?>

        <!-- on lance l'animation de success -->
        <script type="text/javascript">
            swal({
                title: "Succès!",
                text: "Envoie Réussi",
                type: "success",
            });
        </script>
        <?php
    }

    // si il y a des erreur et que le formulaire à été validé
    if (isset($erreur) && isset($_POST['bouton'])) {
    // on lance l'animation d'erreur affichant la liste de toute les erreurs
        echo '
                <script type="text/javascript">
                sweetAlert("Echec","' . $erreur . '","error");
                </script>';
    }

}

// on inclut la vue (partie visible => front) de la page
require_once('views/user.view.php');

?> 