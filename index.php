<?php
    // importer les ressources
    use app\controller\userController;
    //ajouter avec use le RolesController
    include './app/utils/BddConnect.php';
    include './app/utils/fonctions.php';
    // include le model et le controler Roles
    include './app/model/Utilisateur.php';
    include './app/controller/userController';
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    //instancier le controller roles

    //routeur
    switch ($path) {
        case '/CHOCOBLAST/':
            include './app/vue/home.php';
            break;
        case '/CHOCOBLAST/userAdd':
            //appel de la fonction insertUser :
            include './app/vue/viewAddUser.php';
            break;
            //case pour ajoute un roles 
        default:
            include './app/vue/error.php';
            break;
    }
?>