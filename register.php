<?php
// on définit notre balise title
$title = "Page d'Inscription";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');


// on check l'input pour le mail,password,password de confirmation,
// nom,prenom,rue,code postal,ville,numéro de téléphone
// si il y une erreur on affecte le problème dans la variable d'erreur 
// qui s'occupe d'aficher dans une pop-up toutes les erreurs si il y en a
if ((isset($_REQUEST['email'])) && (trim($_REQUEST['email']) !== '') && (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))) {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le champ email n'est pas au bon format";
    } else {
        $erreur = "Le champ email n'est pas au bon format";
    }

}

if (!isset($_REQUEST['email']) || trim($_REQUEST['email']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> L'email est manquant";
    } else {
        $erreur = "L'email est manquant";
    }
}

if (!empty($_REQUEST['email'])) {
    $reponse = Bdd::getInstance()->conn->query('SELECT mail FROM users WHERE mail = "' . $_POST['email'] . '" ');
    $mail = $reponse->fetch();

    if (strtolower($_POST['email']) == strtolower($mail['mail'])) {
        $erreur = "Cette adresse de mail est déjà utilisée";
    }
}

if (!isset($_REQUEST['password']) || trim($_REQUEST['password']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le champ password est incomplet";
    } else {
        $erreur = "Le champ password est incomplet";
    }

}

if (!isset($_REQUEST['confirm']) || trim($_REQUEST['confirm']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le mot de passe de confirmation est incomplet";
    } else {
        $erreur = "Le mot de passe de confirmation est incomplet";
    }

}

if (isset($_REQUEST['confirm']) && isset($_REQUEST['password']) && ($_REQUEST['confirm']) != ($_REQUEST['password'])) {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Les deux mots de passe ne correspondent pas";
    } else {
        $erreur = "Les deux mots de passe ne correspondent pas";
    }

}

if (!isset($_REQUEST['nom']) || trim($_REQUEST['nom']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le champ nom est incomplet";
    } else {
        $erreur = "Le champ nom est incomplet";
    }

}

if (!isset($_REQUEST['prenom']) || trim($_REQUEST['prenom']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le  champ prenom est incomplet";
    } else {
        $erreur = "Le champ prenom est incomplet";
    }

}

if (!isset($_REQUEST['rue']) || trim($_REQUEST['rue']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le champ adresse est incomplet";
    } else {
        $erreur = "Le champ adresse est incomplet";
    }

}

if (!isset($_REQUEST['cp']) || trim($_REQUEST['cp']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le champ code postal est incomplet";
    } else {
        $erreur = "Le champ code postal est incomplet";
    }

}

if (!isset($_REQUEST['ville']) || trim($_REQUEST['ville']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le champ ville est incomplet";
    } else {
        $erreur = "Le champ ville est incomplet";
    }

}

if (!isset($_REQUEST['telportable']) || trim($_REQUEST['telportable']) === '') {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Veuillez renseigner un numéro de télphone";
    } else {
        $erreur = "Veuillez renseigner un numéro de télphone";
    }

} else if (!preg_match("#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#", $_REQUEST['telportable']) && $_REQUEST['telportable'] != NULL) {
    if (isset($erreur)) {
        $erreur = $erreur . " <br/> Le numéro de téléphone renseigné n'est pas au bon format";
    } else {
        $erreur = "Le numéro de téléphone portable n'est pas au bon format";
    }

}


// si il n'y a pas d'erreur et que le formulaire a été validé 
if (isset($_POST['bouton']) && !isset($erreur)) {

    // on passe dans des variables les valeurs rentré dand les inputs tout en rajouter une guillemet simple 
    // au début et à la fin de la valeur renté afin d'éviter que mysql nous déclenche une erreur et 
    // pour éviter php nous déclenche une erreur on met à chaque fois un antislash car sinon php va 
    // l'interpreter comme une guillemet qui à pour but de concaténer une requête sql
    $email = '\'' . $_REQUEST['email'] . '\'';
    $emailbis = $_REQUEST['email'];

    // on récupère la valeur du champ password, puis on le hash avec la fonction password_hash de php
    // en utilisant une signature de 12 characteres afin d'éviter qu'un hacker puisse remonter 
    // à son mot de passe en clair
    $password = $_REQUEST['password'];
    $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    $hashedPassword = '\'' . $hashPassword . '\'';

    $nom = '\'' . $_REQUEST['nom'] . '\'';
    $prenom = '\'' . $_REQUEST['prenom'] . '\'';
    $rue = '\'' . $_REQUEST['rue'] . '\'';
    $cp = '\'' . $_REQUEST['cp'] . '\'';
    $ville = '\'' . $_REQUEST['ville'] . '\'';
    $portable = '\'' . $_REQUEST['telportable'] . '\'';


    // on éxecute l'insert des données pour la création du compte
    Bdd::getInstance()->conn->exec('INSERT INTO users (nom,prenom,rue,code_postal,ville,mail,telephone,
            password) VALUES (' . $nom . ',' . $prenom . ',' . $rue . ',' . $cp . ',' . $ville . ',' . $email . ',' . $portable . ',' . $hashedPassword . ')');

    //On vérifie que le user à bien été inséré dans la database
    $result = Bdd::getInstance()->conn->query('SELECT * FROM `users` WHERE `mail` LIKE "' . $emailbis . '" AND `password` LIKE "' . $hashPassword . '"');

    // Si c'est bon on crée une variable session pour le user
    foreach ($result as $row) {
        $_SESSION['login'] = $row['id'];
    }

    ?>

    <!-- on lance l'animation de success puis on redirige sur la page de connection-->
    <script type="text/javascript">
        Swal.fire({
            title: "Succès!",
            icon: "success",
            text: "Votre compte à bien été créé",

        }).then(function () {
            window.location.href = "login.php";
        });
    </script>
    <?php
}


// si il y a des erreur et que le formulaire à été validé
// on lance l'animation d'erreur affichant la liste de toute les erreurs
if (isset($_POST['bouton']) && isset($erreur)) {
    echo '
        <script type="text/javascript">
            Swal.fire({
              title: "Erreur",
              icon: "error",
              html: " ' . $erreur . ' ",
            })
        </script>';
}

// on inclut la vue (partie visible => front) de la page
require_once('views/register.view.php');
?>
    