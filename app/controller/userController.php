<?php
    namespace app\controller;
    use app\model\Utilisateur;
    use app\utils\Fonctions;
    class UserController extends Utilisateur{ // le role de la classe ontroler est de gérer toute la logique t l'ajout d'utilisateurs en base de données
        // fonction qui va gérer l'ajout d'un utilisateur en BDD (et toute la construction de ma page)
        public function insertUser() {
            // variable pour stocker le message
            $msg = "";
            //logique
            // test si le bouton est cliqué 
            if(isset($_POST['submit'])) {
                // recupération et nettoyage des inputs utilisateurs
                $nom = Fonctions::cleanInput ($_POST['nom_utilisateur']);
                $prenom = Fonctions::cleanInput ($_POST['prenom_utilisateur']);
                $mail = Fonctions::cleanInput ($_POST['mail_utilisateur']);
                $password = Fonctions::cleanInput ($_POST['password_utilisateur']);
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
                    // echo '</pre>';
                    //récupérer le mail dans un objet :
                    $this->setMailUtilisateur($mail);
                    //tester si le compte existe déja
                    if($this->getUserByMail()){
                        $msg = "Les informations sont incorrectes";
                    }
                    //test si le compte n'existe pas
                    else{
                        //hash du mot de passe
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        //version alternative avec $this
                        $this->setNomUtilisateur($nom);
                        $this->setPrenomUtilisateur($prenom);
                        $this->setPasswordUtilisateur($password);
                        //ajout du compte en BDD
                        $this->addUser();
                        //affichage de l'erreur
                        $msg = "Le compte : ".$mail." a été ajouté en BDD";
                    }
                }
                //sinon si les champs ne sont pas tous remplis :
                else {
                    $msg = "Veuillez remplir tous les champs du formulaire";
                }
            }
            // importer la vue
            $msg='f';
            include './app/vue/viewAddUser.php';

        }

        public function connexionUser() {
            // variable pour stocker le message
            $msg = "";
            $valide="";
            //logique
            // test si le bouton est cliqué 
            if(isset($_POST['submit'])) {
                // recupération et nettoyage des inputs utilisateurs
                $mail = Fonctions::cleanInput ($_POST['mail_utilisateur']);
                $password = Fonctions::cleanInput ($_POST['password_utilisateur']);
                //nettoyer le code malveillant :
                // tester si les champs sont remplis
                if(!empty($mail) AND !empty($password)) {
                    //récupérer le mail dans un objet avec set (les valeurs à l'objet) :
                    $this->setMailUtilisateur($mail);
                    $this->setPasswordUtilisateur($password);
                    //stocker le compte si il existe :
                    $data = $this -> getUserByMail();
                    //tester si le compte existe
                    if($data){
                        //tester si le mp est valide :
                        if(password_verify($password, $data[0] -> password_utilisateur)) {
                            //Créer les super globales de session
                            $_SESSION['connected'] = true;
                            $_SESSION['nom'] = $data[0]->nom_utilisateur;
                            $_SESSION['prenom'] = $data[0]->prenom_utilisateur;
                            $_SESSION['mail'] = $data[0]->mail_utilisateur;
                            $_SESSION['id'] = $data[0]->id_utilisateur;
                            $valide ="connecté";
                        }
                        // si le mp n'existe pas/est correcte :
                        else {
                            $msg = "Les informations de connexion sont invalides";
                        }
                    }
                    // test si le compte existe pas :
                    else {
                        $msg="les informations de connexion sont invalides";
                    }
                }
                // tester si les champs sont vides :
                else {
                    $msg ="Veuillez remplir tous les champs de formulaire";
                }
            }
            //import de la vue pour la connexion :
            // $msg='f';
            include './app/vue/viewConnexion.php';
        }
    }
?>