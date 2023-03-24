<?php
    // Démarrer la session
    // pour enregistrer les données de connexion par exemple jsuqu'à ce que la page soit fermée = déconnexion
    session_start(); // on le met juste ici pour pouvoir l'avoir sur les autres pages
    // importer les ressources
    use app\controller\UserController;
    use app\controller\RolesController;
    //ajouter avec use le RolesController
    include './app/utils/BddConnect.php';
    include './app/utils/Fonctions.php';
    // include le model et le controller Roles
    include './app/model/Roles.php';
    include './app/controller/RolesController.php';
    include './app/model/Utilisateur.php';
    include './app/controller/UserController.php';

    
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    //instancier le controller roles

    //routeur
    switch ($path) {
        case '/CHOCOBLAST/':
            include './app/vue/home.php';
            break;
        case '/CHOCOBLAST/userAdd':
            //appel de la fonction insertUser :
            $userController -> insertUser();
            break;
            //case pour ajoute un roles 
        case '/CHOCOBLAST/rolesAdd':
            //appel de la fonction insertRoles
            $rolesController -> insertRoles();
            break; 
        case '/CHOCOBLAST/connexion':
            $userController -> connexionUser();
        default:
            include './app/vue/error.php';
            break;
    }
?>