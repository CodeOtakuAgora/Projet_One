<?php
// on définit notre balise title
$titleUser = "Page Profil";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on vérifie que c'est bien le user qui est connecté
if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {

    // fonction qui retourne le fichier en sécurisant les données envoyées
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // on définit le chemin du dossier pour stocker l'image
    // puis on stocke le nom, l'extension de l'image ainsi que le chemin relatif de l'endroit ou l'image doit etre stocké
    $image = '';
    $imagePath = '';
    $imageExtension = '';

    $image2 = '';
    $imagePath2 = '';
    $imageExtension2 = '';
    if (isset($_POST['bouton'])) {
        $image = checkInput($_FILES["logo"]["name"]);
        $imagePath = 'ressources/vetements/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

        $image2 = checkInput($_FILES["logo2"]["name"]);
        $imagePath2 = 'ressources/vetements/' . basename($image2);
        $imageExtension2 = pathinfo($imagePath2, PATHINFO_EXTENSION);
    }

    if ($image != '' && $image2 != '') 
    {
        // on vérifie l'extension,taille,nom du fichier envoyé pour les 2 images
        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $erreur = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }

        if ($imageExtension2 != "jpg" && $imageExtension2 != "png" && $imageExtension2 != "jpeg" && $imageExtension2 != "gif") {
            $erreur = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }

        if (file_exists($imagePath)) {
            $erreur = "Le fichier 1 existe deja";
            $isUploadSuccess = false;
        }

        if (file_exists($imagePath2)) {
            $erreur = "Le fichier 2 existe deja";
            $isUploadSuccess = false;
        }

        if (!empty($_FILES["logo"]) && $_FILES["logo"]["size"] > 500000) {
            $erreur = "Le fichier 1 ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }

        if (!empty($_FILES["logo2"]) && $_FILES["logo2"]["size"] > 500000) {
            $erreur = "Le fichier 2 ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }
        // on vérifie si le fichier à bien été déplacé dans le chemin spécifié
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["logo"]["tmp_name"], $imagePath)) {
                $erreur = "Il y a eu une erreur lors de l'upload pour le logo 1";
                $isUploadSuccess = false;
            }
            if (!move_uploaded_file($_FILES["logo2"]["tmp_name"], $imagePath2)) {
                $erreur = "Il y a eu une erreur lors de l'upload pour le logo 2";
                $isUploadSuccess = false;
            }
        }
    }  

    // on check l'input pour le nom, description, prix, logo, logo2
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
    if (!isset($_FILES['logo'])) {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le logo est manquant";
        } else {
            $erreur = "Le logo est manquant";
        }
    }

    if (!isset($_FILES['logo2'])) {
        if (isset($erreur)) {
            $erreur = $erreur . " \\n Le logo 2 est manquant";
        } else {
            $erreur = "Le logo 2 est manquant";
        }
    }


    // si il n'y a pas d'erreur et que le formulaire a été validé 
    if (!isset($erreur) && isset($_POST['bouton'])) {
        // on passe dans des variables les valeurs rentré dand les input
        $nom = '\'' . $_REQUEST['nom'] . '\'';
        $description = '\'' . $_REQUEST['description'] . '\'';
        $prix = '\'' . $_REQUEST['prix'] . '\'';
        $logo = '\'' . basename($image) . '\'';
        $logo2 = '\'' . basename($image2) . '\'';
        $category = '\'' . $_REQUEST['category'] . '\'';
        $souscategory = '\'' . $_REQUEST['souscategory'] . '\'';
        $id_admin = 1;
        $confirme = 0;



        // on éxecute l'insert des données pour l'ajout du produit avec confirme = 0
        // pour info un produit avec le champ confirme = 0 n'est pas encore disponible
        // à la vente, car il faut que l'admin passe cette valeur à 1
        Bdd::getInstance()->conn->exec('INSERT INTO produits (nom,description,prix,logo,logo2,id_categorie,id_sous_categorie,id_admin,confirme) 
            VALUES (' . $nom . ',' . $description . ',' . $prix . ',' . $logo . ',' . $logo2 . ',' .
                     $category . ',' . $souscategory . ',' . $id_admin . ',' . $confirme . ')');

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