<?php
    namespace app\controller;
    use app\model\utilisateur;
    use app\utils\fonctions;
    class userController extends utilisateur{ // le role de la classe ontroler est de gérer toute la logique t l'ajout d'utilisateurs en base de données
        // fonction qui va gérer l'ajout d'un utilisateur en BDD (et toute la construction de ma page)
        public function insertUser() {
            // variable pour stocker le message
            $msg = "";
            //logique
            // test si le bouton est cliqué 
            if(isset($_POST['submit'])) {
                // recupération et nettoyage des inputs utilisateurs
                $nom = fonctions :: cleanInput ($_POST['nom_utilisateur']);
                $prenom = fonctions :: cleanInput ($_POST['prenom_utilisateur']);
                $mail = fonctions :: cleanInput ($_POST['mail_utilisateur']);
                $password = fonctions :: cleanInput ($_POST['password_utilisateur']);
                //nettoyer le code malveillant :
                // tester si les champs sont remplis
                if(!empty($nom) AND !empty($prenom) AND !empty($mail) AND !empty($password)) {
                    // hashage du mot de pass pour le crypter
                    // $password = password_hash($password, PASSWORD_DEFAULT);
                    // $user = new Utilisateur();
                    // $user -> setNomUtilisateur($nom);
                    // $user -> setPrenomUtilisateur($prenom);
                    // $user -> setMailUtilisateur($mail);
                    // $user -> setPasswordUtilisateur($password);
                    // var_dump($user);
                    echo '</pre>';
                    // version alternative avec $this :
                    $this -> setNomUtilisateur($nom);
                    $this -> setPrenomUtilisateur($prenom);
                    $this -> setMailUtilisateur($mail);
                    $this -> setPasswordUtilisateur($password);
                    $this -> addUser();
                    $msg = "Le compte : ".$mail." a été ajouté en BDD";
                }
                //sinon si les champs ne sont pas tous remplis :
                else {
                    $msg = "Veuillez remplir tous les champs du formulaire";
                }
            }
            // importer la vue
            include './app/vue/viewAddUser.php';
        }
    }
?>