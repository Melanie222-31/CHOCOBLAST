<?php
namespace app\controller;
use app\utils\Fonctions;
use app\model\Commentaire;
    class CommentaireController extends Commentaire{ 
        //Méthode qui va ajouter un commentaire en BDD
        public function insertCommentaire():void{
            //Test si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                //Générer la liste déroulante cible
                // $user = new Utilisateur();
                // $data = $user->getUserAll();
                //Variable pour stocker les messages d'erreur
                $msg = "";
                //Tester si le formulaire est submit
                if(isset($_POST['submit'])){
                    //Nettoyer les inputs, les entrée :
                    $note = Fonctions::cleanInput($_POST['note_commentaire']);
                    $text = Fonctions::cleanInput($_POST['text_commentaire']);
                    $date = Fonctions::cleanInput($_POST['date_commentaire']);
                    $auteur = Fonctions::cleanInput($_SESSION['id']);
                    $choco = Fonctions::cleanInput($_GET['id_chocoblast']);
                    //Test si les champs sont remplis
                    if(!empty($note) AND !empty($text) AND !empty($date) 
                    AND !empty($auteur) and !empty($choco)){
                        //Setter les valeurs à l'objet
                        $this->setNoteCommentaire($note);
                        $this->setTextCommentaire($text);
                        $this->setDateCommentaire($date);
                        // là on a besoin de récupéter l'utilisateur (à vérifier dans le fichier commentaire.php) :
                        $this->getAuteurCommentaire()->setIdUtilisateur($auteur);
                        // là dans la class chocoblast :
                        $this->getChocoblastCommentaire()->setIdChocoblast($choco);
                        //Ajouter en BDD le commentaire :
                        $this->addCommentaire();
                        $msg ='Votre commentaire a été ajouté';
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                    }
                    // tester sinon le champs ne sont pas remplis :
                    else {
                        $msg = "Veuillez remplir tous les champs du formulaire";
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                    }
                    //Import de la vue
                    include './App/Vue/viewAddCommentaire.php';
                }      
            }
            // Sinon,  si l n'est pas connecté, redirection vers le viewAllChcoblast = l'affichatde de tous les chocoblasts
            else {
                header('Location: ./chocoblastAll');
            }
        }
    }
?>