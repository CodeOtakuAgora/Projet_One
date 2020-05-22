<?php
// on définit notre balise title
$title = "Page d'Inscription";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');


// on check l'input pour le mail,password,password de confirmation,
// nom,prenom,rue,code postal,ville,numéro de téléphone
// si il y une erreur on affecte le problème dans la variable d'erreur 
// qui s'occupe d'aficher dans une pop-up toutes les erreurs si il y en a

$erreur = '';

if (isset($_POST['bouton'])) {

    $erreur = Formulaire::inputIsItEmpty('email', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('password', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('confirm', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('nom', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('prenom', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('rue', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('cp', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('ville', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('telportable', $erreur);

    if (empty($erreur)) {
        $erreur = Formulaire::checkEmailFomat('email', $erreur);
        $erreur = Formulaire::checkConfirmPassword($_REQUEST['password'], $_REQUEST['confirm'], $erreur);
        $erreur = Formulaire::checkTelFormat('telportable', $erreur);

        if (!empty($_REQUEST['email']) && empty($erreur)) {
            $exist = User::isItUserExist($_REQUEST['email']);
            $exist = $exist->res;
            $erreur = Formulaire::isItEmailExist($exist, $erreur);
        }
    }
}


// si il n'y a pas d'erreur et que le formulaire a été validé 
if (isset($_POST['bouton']) && empty($erreur)) {

    // on passe dans des variables les valeurs rentré dand les inputs tout en rajouter une guillemet simple 
    // au début et à la fin de la valeur renté afin d'éviter que mysql nous déclenche une erreur et 
    // pour éviter php nous déclenche une erreur on met à chaque fois un antislash car sinon php va 
    // l'interpreter comme une guillemet qui à pour but de concaténer une requête sql
    $email = $_REQUEST['email'];
    $nom = $_REQUEST['nom'];
    $prenom = $_REQUEST['prenom'];
    $rue = $_REQUEST['rue'];
    $cp = $_REQUEST['cp'];
    $ville = $_REQUEST['ville'];
    $portable = $_REQUEST['telportable'];

    // on récupère la valeur du champ password, puis on le hash avec la fonction password_hash de php
    // en utilisant une signature de 12 characteres afin d'éviter qu'un hacker puisse remonter
    // à son mot de passe en clair
    $password = $_REQUEST['password'];
    $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    // on éxecute l'insert des données pour la création du compte
    User::setUser($email, $hashPassword, $nom, $prenom, $rue, $cp, $ville, $portable);

    //On vérifie que le user à bien été inséré dans la database
    $result = User::checkInformation($_REQUEST['email'], $hashPassword);
    $result = $result->id;

    // Si c'est bon on crée une variable session pour le user
    $_SESSION['login'] = $result;

    // on lance l'animation de success puis on redirige sur la page de connection
    Formulaire::triggerSuccessAnimation('login', 'Votre compte à bien été créé', 'index.php');

}

// si il y a des erreur et que le formulaire à été validé
// on lance l'animation d'erreur affichant la liste de toute les erreurs
if (isset($_POST['bouton']) && !empty($erreur)) {
    Formulaire::triggerErrorsAnimation($erreur, 'bouton');
}

// on inclut la vue (partie visible => front) de la page
require_once('views/register.view.php');
?>
    