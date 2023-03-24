<?php
namespace app\controller;
use app\model\Roles;
use app\utils\Fonctions;
    class RolesController extends Roles{ // le role de la classe ontroler est de gérer toute la logique t l'ajout d'utilisateurs en base de données
        // fonction qui va gérer l'ajout d'un utilisateur en BDD (et toute la construction de ma page)
        public function insertRoles():void {
            // variable pour stocker le message
            $msg = "";
            //logique
            // test si le bouton est cliqué 
            // tester si le formulaire est submit :
            if(isset($_POST['submit'])) {
                
                //nettoyer le code malveillant, les imput, les entrées :
                $nom = Fonctions::cleanInput($_POST['nom_roles']);
                // tester si les champs sont remplis
                if(!empty($nom)) {
                    // Setter les valeurs à l'objet :
                    $this -> setNomRoles($nom);
                    //si le roles existe déjà :
                    if($this->getRolesByName()){
                        $msg = "Le role : ".$nom." existe déjà en BDD";
                    }
                    // test s'il n existe pas :
                    else {
                        $this -> addRoles();
                        // afficher la confirmation :
                        $msg = "Le role :".$nom." a été ajouté en BDD";
                    }                   
                }
                //sinon si les champs ne sont pas tous remplis :
                else {
                    // afficher l'erreur :
                    $msg = "Veuillez remplir les champs du formulaire";
                }
            }
            // importer la vue
            include './app/vue/viewAddRoles.php';
        }
    }
?>