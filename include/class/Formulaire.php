<?php

// class Categorie qui définit toute les charactéristiques d'une categorie avec pleins de fonctions
// qui le définissent et qui lui sont propres
// récupère et donc à accès à toutes les fonction de sa class mère (Bdd)
class Formulaire extends Bdd
{
    public static function checkEmailFomat($inputEmail, $erreur) {
        if ((isset($_REQUEST[$inputEmail])) && (trim($_REQUEST[$inputEmail]) !== '') &&
            (!filter_var($_REQUEST[$inputEmail], FILTER_VALIDATE_EMAIL))) {
            $erreur = "Le champ email n'est pas au bon format <br/>";
        }
        return $erreur;
    }

    public static function checkTelFormat($inputTel, $erreur) {
        if (!preg_match("#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#", $_REQUEST[$inputTel])
            && !empty($_REQUEST[$inputTel])) {
            $erreur = "Le numéro de téléphone renseigné n'est pas au bon format </br>";
        }
        return $erreur;
    }

    public static function inputIsItEmpty($inputElement, $erreur) {
        if (!isset($_REQUEST[$inputElement]) || trim($_REQUEST[$inputElement]) === '') {
            $erreur = "Le champ $inputElement est manquant <br/>";
        }
        return $erreur;
    }

    public static function inputFileIsItEmpty($inputFileElement, $erreur) {
        if (empty($_FILES[$inputFileElement]["name"]["0"])) {
            $erreur = "Le champ $inputFileElement est manquant <br/>";
        }
        return $erreur;
    }

    public static function checkConfirmPassword($password, $confirm, $erreur) {
        if (!empty($confirm) && !empty($password) && ($confirm) != ($password)) {
            $erreur = "Les deux mots de passe ne correspondent pas <br/>";
        }
        return $erreur;
    }

    public static function isItEmailExist($exist, $erreur) {
        if ($exist == '1') {
            $erreur = "Cette adresse de mail est déjà utilisée";
        }
        return $erreur;
    }

    public static function checkFields($verify, $erreur) {
        if ($verify === false) {
            $erreur = "Couple adresse mail/mot de passe erroné <br/>";
        }
        return $erreur;
    }

    // fonction qui retourne le fichier en sécurisant les données envoyées
    public static function checkSecureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    public static function verifyExtensionFile($inputFileElement, $imageExtension, $erreur) {
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $erreur = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif pour le champ $inputFileElement";
        }
        return $erreur;
    }

    public static function verifyAlreadyFileExist($inputFileElement, $imagePath, $erreur) {
        if (file_exists($imagePath)) {
            $erreur = "Le fichier du champ $inputFileElement existe deja";
        }
        return $erreur;
    }

    public static function verifySizeFile($fileName, $fileSize, $inputFileElement, $erreur) {
        if (!empty($fileName) && ($fileSize > 500000)) {
            $erreur = "Le fichier du champ $inputFileElement ne doit pas depasser les 500KB";
        }
        return $erreur;
    }

    public static function verifyUploadFile($fileTmp, $isUploadSuccess, $inputFileElement, $imagePath, $erreur) {
        if ($isUploadSuccess) {
            if (!move_uploaded_file($fileTmp, $imagePath)) {
                $erreur = "Il y a eu une erreur lors de l'upload pour le champ $inputFileElement";
            }
        }
        return $erreur;
    }

    public static function triggerSuccessAnimation($session, $message, $location) {
        if (isset($_SESSION[$session])) { ?>
            <!-- on lance l'animation de success puis on redirige sur la page de connection-->
            <script type="text/javascript">
                Swal.fire({
                    title: "Succès!",
                    icon: "success",
                    html: " <?php echo $message; ?> ",
                }).then(function () {
                    window.location.href = " <?php echo $location; ?> ";
                });
            </script>
            <?php
        }
    }

    public static function triggerErrorsAnimation($errors, $bouton) {
        if (isset($errors) && isset($_POST[$bouton])) { ?>
            <script type = "text/javascript">
                Swal.fire({
                      title: "Erreur",
                      icon: "error",
                      html: "<?php echo $errors; ?>",
                    });
            </script>
            <?php
        }
    }

}