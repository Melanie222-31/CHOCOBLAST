<?php
namespace app\controller;
use app\utils\Fonctions;
use app\model\Utilisateur;
use app\model\Chocoblast;
    class ChocoblastController extends Chocoblast{ 
        // Métode qui va ajouter un chocoblast
        public function insertChocoblast():void {
            //test si l'utilisateur est connexté :
            if(isset($_SESSION['connected'])){
                //Générer une liste déroulante :
                $user = new Utilisateur();
                $data = $user -> getUserAll();
                // variable pour stocker le message
                $msg = "";
            }
            //logique
            // test si le bouton est cliqué  = tester si le formulaire est submit :
            if(isset($_POST['submit'])) {
                
                //nettoyer le code malveillant, les imput, les entrées :
                $slogan = Fonctions::cleanInput($_POST['slogan_chocoblast']);
                $date = Fonctions::cleanInput($_POST['date_chocoblast']);
                $cible = Fonctions::cleanInput($_POST['cible_chocoblast']);
                //récupération des valeurs :
                $auteur = $_SESSION['id'];
                // tester si les champs sont remplis
                if(!empty($slogan) AND !empty($date) AND !empty($cible) AND !empty($auteur)) {
                    // Setter les valeurs à l'objet :
                    $this -> setSloganChocoblast($slogan);
                    $this -> setDateChocoblast($date);
                    //on récupère l'objjet, et sur le get cible on va lui faire IdUtilisateur :
                    $this -> getCibleChocoblast()->setIdUtilisateur($cible);
                    $this -> getAuteurChocoblast()->setIdUtilisateur($auteur);
                    // Tester si le chocoblast existe déjà = vérification des doublons :
                    if ($this-> getChocoblastByInfo ()){
                    $msg = "Votre slogan :".$slogan." existe déjà en BDD";  
                    }           
                    // Tester si'il ils n'existent pas : 
                    else {
                        // afficher l'erreur :
                        $this-> addChocoblast();
                        $msg = "Votre slogan :".$slogan." a été ajouté en BDD"; 
                    }
                }
                // importer la vue
                include './app/vue/viewAddChocoblast.php';
            }
                // test sinon on redirige vers accueil :
            else {
            header('Location: ./');
            }
        } 
    }
    
?>