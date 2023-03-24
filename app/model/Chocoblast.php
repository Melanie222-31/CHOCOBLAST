<?php

namespace app\model;
use app\model\Utilisateur;
use app\utils\BddConnect;
class Chocoblast extends BddConnect {
    //Atributs :
    private ?int $id_chocoblast;
    private ?string $slogan_chocoblast;
    private ?string $date_chocoblast;
    private ?bool $statut_chocoblast;
    private ?Utilisateur $cible_chocoblast;
    private ?Utilisateur $auteur_chocoblast;
    //constructeur :
    public function __construct(){
        // instance de deux objets utilisateur
        $this->cible_chocoblast = new Utilisateur();
        $this->auteur_chocoblast= new Utilisateur();
        //passer le statut à true :
        $this->statut_chocoblast= true;
    }
    // getters et setters :
    public function getIdChocoblast():?int { // ? int pour le forcer à faire un retour en format entier ou nul
        return $this -> id_chocoblast;
    }
    public function getSloganChocoblast():?string { // ? int pour le forcer à faire un retour en format chaine de caractère ou nul
        return $this -> slogan_chocoblast;
    }
    public function getDateChocoblast():?string {
        return $this -> date_chocoblast;
    }
    public function getStatutChocoblast():?string {
        return $this -> statut_chocoblast;
    }   
    public function getCibleChocoblast():?Utilisateur {
        return $this -> cible_chocoblast;
    } 
    public function getAuteurChocoblast():?Utilisateur {
        return $this -> auteur_chocoblast;
    } 
    // (pour les set on ne mets pas l'ID car on ne le créé pas nous meme, on va aller le chercher dans la base de donner)
    public function setIdChocoblast(?string $id):void {
        $this -> id_chocoblast= $id;
    }
    public function setSloganChocoblast(?string $slogan):void {
        $this -> slogan_chocoblast= $slogan;
    }
    public function setDateChocoblast(?string $date):void {
        $this -> date_chocoblast = $date;
    }
    public function setStatutChocoblast(?Utilisateur $statut):void {
        $this -> statut_chocoblast = $statut;
    }
    public function setCibleChocoblast(?Utilisateur $cible):void {
        $this -> cible_chocoblast = $cible;
    }

    //Méthodes
    // Méthode pour ajouter un chocoblast en BDD
    public function addChocoblast():void {
        try{     // (si j'ai la moindre erreur dans le try, on rentre dans le catch pour exécuter une erreur)
            // récupérer les données 
            $slogan = $this -> getSloganChocoblast();
            $date = $this -> getDateChocoblast();
            $statut = $this -> getStatutChocoblast();
            // récupération de cible :
            $cible = $this->cible_chocoblast->getIdUtilisateur();
            // récupération de auteur :
            $auteur = $this->auteur_chocoblast->getIdUtilisateur();
            // prépaprer la requete
            $req = $this -> connexion() -> prepare('INSERT INTO chocoblast(slogan_chocoblast, date_chocoblast, statut_chocoblast, cible_chocoblast, auteur_chocoblast) VALUES(?,?,?,?,?)');
            // blind les paramètres
            $req -> bindParam (1, $slogan, \PDO::PARAM_STR);
            $req -> bindParam (2, $date, \PDO::PARAM_STR);
            $req -> bindParam (3, $statut, \PDO::PARAM_STR);
            //blind de cible :
            $req -> bindParam (4, $cible, \PDO::PARAM_STR);
            //blind de auteur :
            $req -> bindParam (5, $auteur, \PDO::PARAM_STR);
            // Executer la requete
            $req -> execute();
        }
        catch  (\Exception $e) {
            die ('Erreur : ' .$e -> getMessage());
        }
    } 
     //Méthode qui retourne un chocoblast par ces informations
     public function getChocoblastByInfo():?array{
        //Récupération des valeurs de l'objet
        $slogan = $this->getSloganChocoblast();
        $date = $this->getDateChocoblast();
        $cible = $this->getCibleChocoblast()->getIdUtilisateur();
        $auteur = $this->getAuteurChocoblast()->getIdUtilisateur();
        //Préparer la requête
        $req = $this->connexion()->prepare('SELECT id_chocoblast, slogan_chocoblast 
        FROM chocoblast WHERE slogan_chocoblast = ? AND date_chocoblast = ?
        AND cible_chocoblast = ? AND auteur_chocoblast = ?');
        //Bind des paramètres
        $req->bindParam(1, $slogan, \PDO::PARAM_STR);
        $req->bindParam(2, $date, \PDO::PARAM_STR);
        $req->bindParam(3, $cible, \PDO::PARAM_INT);
        $req->bindParam(4, $auteur, \PDO::PARAM_INT);
        //Exécution de la requête
        $req->execute();
        //Récupérer le chocoblast
        $data = $req->fetchAll(\PDO::FETCH_OBJ);
        //Retourner le tableau
        return $data;
    }
     //Méthode toString :
    public function __toString(): string{
        return $this -> slogan_chocoblast;
    }
    
}

?>