<?php
namespace app\model;
use app\utils\BddConnect;
use app\model\Roles;
class Utilisateur extends BddConnect {

    //Atributs :
    private ?int $id_utilisateur;
    private ?string $nom_utilisateur;
    private ?string $prenom_utilisateur;
    private ?string $mail_utilisateur;
    private ?string $password_utilisateur;
    private ?string $image_utilisateur;
    private $statut_utilisateur;
    private ?Roles $roles;

    //constructeur :
    public function __construc(){
        // instancer un objet role qd on créé un utilisateur
        // $this -> roles = new Roles ('utilisateur');
    }

    // getters et setters :
    public function getIdUtilisateur():?int { // ? int pour le forcer à faire un retour en format entier ou nul
        return $this -> id_utilisateur;
    }
    public function getNomUtilisateur():?string { // ? int pour le forcer à faire un retour en format chaine de caractère ou nul
        return $this -> nom_utilisateur;
    }
    public function getPrenomUtilisateur():?string {
        return $this -> prenom_utilisateur;
    }
    public function getMailUtilisateur():?string {
        return $this -> mail_utilisateur;
    }
    public function getPasswordUtilisateur():?string {
        return $this -> password_utilisateur;
    }
   
    // (pour les set on ne mets pas l'ID car on ne le créé pas nous meme, on va aller le chercher dans la base de donner)
    public function setNomUtilisateur($name):void {
        $this -> nom_utilisateur= $name;
    }
    public function setPrenomUtilisateur($firstName):void {
        $this -> prenom_utilisateur = $firstName;
    }
    public function setMailUtilisateur($mail):void {
        $this -> mail_utilisateur = $mail;
    }
    public function setPasswordUtilisateur($pwd):void {
        $this -> password_utilisateur = $pwd;
    }

    //Méthodes
    // Méthode pou ajouter un utilisateur en BDD
    public function addUser() {
        try{     // (si j'ai la moindre erreur dans le try, on rentre dans le catch pour exécuter une erreur)
            // récupérer les données 
            $nom = $this -> nom_utilisateur;
            $prenom = $this -> prenom_utilisateur;
            $mail = $this -> mail_utilisateur;
            $password = $this -> password_utilisateur;
        // prépaprer la requete 
        $req = $this -> connexion() -> prepare('INSERT INTO utilisateur(nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur) VALUES(?,?,?,?)');
        // blind les paramètres
        $req -> bindParam (1, $nom, \PDO::PARAM_STR);
        $req -> bindParam (2, $prenom, \PDO::PARAM_STR);
        $req -> bindParam (1, $mail, \PDO::PARAM_STR);
        $req -> bindParam (1, $password, \PDO::PARAM_STR);
        // Executer la requete
        $req -> execute();
        }
        catch  (\Exception $e) {
            die ('Erreur : ' .$e -> getMessage());
        }
    } 
   
    // Métode pour récupéerer un utilisateur avec son mail :
    public function getUserByMail():?array{
        try { // Le mettre dans un try pour éviter d efaire beugé le code
            $mail = $this -> mail_utilisateur;
            $req = $this -> connexion () -> prepare ('SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur, image_utilisateur, statut_utilisateur, id_roles FROM utilisateur WHERE mail_utilisateur = ?');
            $req -> bindParam(1,$mail, \PDO::PARAM_STR);
            $req -> execute(); 
            $data = $req -> fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (\Exception $e) {
            die ('Erreur : ' .$e -> getMessage());
        }
       
    }
        
}

?>