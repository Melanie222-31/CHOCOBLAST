<?php
namespace app\model;
use app\utils\BddConnect;
class Roles extends BddConnect {

    //Atributs :
    private $id_roles;
    private $nom_roles;

    //constructeur :
    public function __construct(){
    }

    // getters et setters :
    public function getIdRoles():?int { // ? int pour le forcer à faire un retour en format entier ou nul
        return $this -> id_roles;
    }
    public function getNomRoles():?string{
        return $this -> nom_roles;
    }
    public function setIdRoles($id):void{
        $this->id_roles = $id;
    }
    public function setNomRoles($name):void{
        $this -> nom_roles = $name;
    }
    // Methodes :
    public function addRoles():void{
        try {
            // récupération des valeurs de l'objet :
        $nom = $this -> nom_roles;
        // préparer la requete :
        $req = $this -> connexion () -> prepare ('INSERT INTO roles(nom_roles) VALUES(?)');
        //binder la valeur de ce point d'interrogation = le parametre :
        $req -> bindParam(1, $nom, \PDO::PARAM_STR); // l'antislash permet de faire référence pour d'utiliser PDO mais la class de PDO connecté
        // Exécuter la requete :
        $req -> execute();
        }
        // gestion des exeptions :
        catch (\Exception $e) {
            die ('Erreur ! :  '.$e -> getMessage());
        }
    }   
    // methode pour récupérer un role par son nom
    public function getRolesByName():array{
        try{
            //récupérer des valeurs de l'objet :
            $nom = $this -> nom_roles;
            // Préparer la requete :
            $req = $this -> connexion() -> prepare ('SELECT id_roles, nom_roles, FROM roles WHERE nom_roles = ?');
            $req->bindParam(1, $nom, \PDO::PARAM_STR);
            //Exécution de la requête
            $req -> execute ();
            //récup d'un resultat ds tableau d'objet 
            $data = $req -> fetchAll(\PDO::FETCH_OBJ);
            //retour d'un tableau d'objet ou null :
            return $data;
        }
        catch(\Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
}

?>