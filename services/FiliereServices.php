<?php


include_once 'connexion/Connexion.php';
include_once 'beans/Filiere.php';
include_once 'dao/IDao.php';


class FiliereServices implements IDao {
    
    private $connexion;
    
    function __construct() {
        $this->connexion = new Connexion();
        
    }
    
    public function create($o) {
        $query = "INSERT INTO filiere VALUES (NULL,?,?)";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($o->getCode(),$o->getLibelle())) or die('Error');
    }

    public function delete($id) {
        $query = "DELETE FROM filiere WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)) or die('error delete');
    }

    public function findAll() {
        $query = "SELECT * FROM filiere";
        $req = $this->connexion->getConnexion()->query($query); // query # prepare
        $f = $req->execute();
        return $f;
   
    }

    public function findAllajax() {
        $query = "SELECT * FROM filiere";
        $req = $this->connexion->getConnexion()->query($query); // query # prepare
        $req->execute();
        $f = $req->fetchAll(PDO::FETCH_OBJ);
        return $f;
    }

    public function findById($id) {
        $query = "SELECT * FROM filiere WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)); 
        $f = $req->fetch(PDO::FETCH_OBJ);
        $filiere = new Filiere($f->id, $f->code, $f->libelle);
        return $filiere;
    }

    public function update($o) {
        $query = "UPDATE filiere SET code=?, libelle=? WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($o->getCode(), $o->getLibelle(), $o->getID()));
    }

    public function findByCode($code){
        $query = "SELECT * FROM filiere WHERE code=? LIMIT 1";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($code));
        $r = $req->fetch(PDO::FETCH_OBJ);
        $result = new Filiere($r->id, $r->code, $r->libelle);
        return $result;
    }


}
