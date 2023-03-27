<?php
    // Démarrer la session
    // pour enregistrer les données de connexion par exemple jsuqu'à ce que la page soit fermée = déconnexion
    session_start(); // on le met juste ici pour pouvoir l'avoir sur les autres pages
    // importer les ressources
    use app\controller\UserController;
    use app\controller\RolesController;
    use app\controller\ChocoblastController;
    use app\controller\CommentaireController;
    //ajouter avec use le RolesController
    include './app/utils/BddConnect.php';
    include './app/utils/Fonctions.php';
    // include le model et le controller Roles
    include './app/model/Roles.php';
    include './app/controller/RolesController.php';
    include './app/model/Utilisateur.php';
    include './app/controller/UserController.php';
    include './app/model/Chocoblast.php';
    include './app/controller/chocoblastController.php';
    include './app/model/Commentaire.php';
    include './app/controller/commentaireController.php';

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    $chocoblastController = new ChocoblastController();
    $commentaireController = new CommentaireController();
    //instancier le controller roles

    //routeur connecte
    if(isset($_SESSION['connected'])){
        switch ($path) {
            case '/CHOCOBLAST/':
                include './app/vue/home.php';
                break;
            case '/CHOCOBLAST/rolesAdd':
                //appel de la fonction insertUser :
                $rolesController -> insertRoles();
                break;
                //case pour ajoute un roles 
            case '/CHOCOBLAST/chocoblastAdd':
                //appel de la fonction insertRoles
                $chocoblastController -> insertChocoblast();
                break; 
            case '/CHOCOBLAST/chocoblastAll':
                $chocoblastController -> showAllChocoblast();
                break; 
            case '/CHOCOBLAST/chocoblastDelete':
                $chocoblastController -> deleteChocoblastById();
                break;
            case '/CHOCOBLAST/chocoblastUYpdate':
                $chocoblastController -> updateChocoblastById();
                break;
            case '/CHOCOBLAST/addCommentaire':
                $commentaireController -> insertCommentaire();
                break;
            case '/CHOCOBLAST/deconnexion':
                $userController -> deconnexionUser();
                break;
            default:
                include './app/vue/error.php';
                break;
        }
    }
    else {
        switch ($path) {
            case '/CHOCOBLAST/':
                include './app/vue/home.php';
                break;
            case '/CHOCOBLAST/userAdd':
                $userController->insertUser();
                break;
            case '/CHOCOBLAST/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/CHOCOBLAST/chocoblastDelete':
                header('Location: ./chocoblastAll');
                break;
            case '/CHOCOBLAST/chocoblastUpdate':
                header('Location: ./chocoblastAll');
                break;
            case '/CHOCOBLAST/connexion':
                $userController->connexionUser();
                break;
            default:
                include './app/vue/error.php';
                break;
        }
    }
?>