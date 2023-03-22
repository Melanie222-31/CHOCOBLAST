<?php
    namespace app\controller;
    use app\model\Roles;
    use app\utils\fonctions;
    class rolesController extends roles{ // le role de la classe ontroler est de gérer toute la logique t l'ajout d'utilisateurs en base de données
        // fonction qui va gérer l'ajout d'un utilisateur en BDD (et toute la construction de ma page)
        public function insertRoles() {
            // variable pour stocker le message
            $msg = "";
            //logique
            // test si le bouton est cliqué 
            if(isset($_POST['submit'])) {
                // recupération et nettoyage des inputs utilisateurs
                $nomRoles = fonctions :: cleanInput ($_POST['nom_roles']);
                //nettoyer le code malveillant :
                // tester si les champs sont remplis
                if(!empty($nom_roles)) {
                    
                    echo '</pre>';
                    // version alternative avec $this :
                    $this -> setNomRoles($nom_roles);
                   
                    $this -> addRoles();
                    $msg = "".$nom_roles." a été ajouté en BDD";
                }
                //sinon si les champs ne sont pas tous remplis :
                else {
                    $msg = "Echec d'ajout à la BDD";
                }
            }
            // importer la vue
            include './app/vue/viewAddRoles.php';
        }
    }
?>