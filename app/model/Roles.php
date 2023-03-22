<?php
namespace app\model;
use app\utils\BddConnect;
class Roles extends BddConnect {

    //Atributs :
    private $id_roles;
    private $nom_roles;

    //constructeur :
    public function __construc($name){
        $this -> nom_roles = $name;
    }

    // getters et setters :
    public function getIdRoles():?int { // ? int pour le forcer à faire un retour en format entier ou nul
        return $this -> id_roles;
    }
    public function getNomRoles():?string{
        return $this -> nom_roles;
    }
    public function setNomRoles($name):void{
        $this -> nom_roles = $name;
    }

    public function addRoles():?string{
        return $this -> nom_roles;
    }
}

?>