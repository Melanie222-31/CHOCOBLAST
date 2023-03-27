<?php
namespace app\model;
// importer les classes
use app\utils\BddConnect;
use app\model\Chocoblast;
use app\model\Utilisateur;
class Commentaire extends BddConnect {
    //attributs :
    private ?int $id_commentaire;
    private ?int $note_commentaire;
    private ?string $text_commentaire;
    private ?string $date_commentaire;
    private ?string $statut_commentaire;
    private ?Chocoblast $id_chocoblast;
    private ?Utilisateur $auteur_commentaire;
    //constructeurs :
    public function __construct () {
        $this -> id_chocoblast = new Chocoblast ();
        $this -> auteur_commentaire = new Utilisateur ();
        // pour forcer que la valeur soit un ou nulle ?
        $this -> statut_commentaire = true;
    }
    // faire tous les getteur et les setteur :
    public function getIdCommentaire ():?int{
        return $this -> id_commentaire;
    }
    public function getNoteCommentaire ():?string{
        return $this -> note_commentaire;
    }
    public function getTextCommentaire ():?string{
        return $this -> text_commentaire;
    }
    public function getDateCommentaire ():?string{
        return $this -> date_commentaire;
    }
    public function getStatutCommentaire ():?bool{
        return $this -> statut_commentaire;
    }
    public function getChocoblastCommentaire ():?Chocoblast{
        return $this -> id_chocoblast;
    }
    public function getAuteurCommentaire ():?Utilisateur{
        return $this -> auteur_commentaire;
    }
    //Setteur :
    public function setIdCommentaire (int $id):void{
        $this -> id_commentaire = $id;
    }
    public function setNoteCommentaire (int $note):void{
        $this -> note_commentaire= $note;
    }
    public function setTextCommentaire (string $text):void{
        $this -> text_commentaire = $text;
    }
    public function setDateCommentaire (string $date):void{
        $this -> date_commentaire = $date;
    }
    public function setStatutCommentaire (?bool $statut):void{
        $this -> statut_commentaire = $statut;
    }
    public function setChocoblastCommentaire (?Chocoblast $choco):void{
        $this -> id_chocoblast = $choco;
    }
    public function setAuteurCommentaire (?Utilisateur $auteur):void{
        $this -> auteur_commentaire = $auteur;
    }
    // Méthodes :
    public function addCommentaire():void{
        try{
            //Récupérer les valeurs de l'objet
            $note = $this->note_commentaire;
            $text = $this->text_commentaire;
            $date = $this->date_commentaire;
            $statut = $this->statut_commentaire;
            $auteur = $this->auteur_commentaire->getIdUtilisateur();
            $chocoblast = $this->id_chocoblast->getIdChocoblast();
            //Préparer la requête
            $req = $this->connexion()->prepare('INSERT INTO commentaire(note_commentaire, text_commentaire, 
            date_commentaire, statut_commentaire, auteur_commentaire, id_chocoblast) VALUES 
            (?,?,?,?,?,?)');
            //Bind les paramètres
            $req->bindParam(1, $note, \PDO::PARAM_INT);
            $req->bindParam(2, $text, \PDO::PARAM_STR);
            $req->bindParam(3, $date, \PDO::PARAM_STR);
            $req->bindParam(4, $statut, \PDO::PARAM_BOOL);
            $req->bindParam(5, $auteur, \PDO::PARAM_INT);
            $req->bindParam(6, $chocoblast, \PDO::PARAM_INT);
            //Exécuter la requête
            $req->execute();
        } 
        catch (\Exception $e) {
            die('Erreur :'.$e->getMessage());
        }
    }
}
?>