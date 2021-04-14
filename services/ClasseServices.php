<?php


include_once 'connexion/Connexion.php';
include_once 'beans/Classe.php';
include_once 'dao/IDao.php';
include_once 'services/FiliereServices.php';


class ClasseServices implements IDao{
    
    private $connexion;
    
    function __construct() {
        $this->connexion = new Connexion();
    }

    
    public function create($o) {
        $query = "INSERT INTO classe VALUES (NULL,?,?)";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($o->getCode(),$o->getfiliere()->getId())) or die('Error');
    }

    public function delete($id) {
        $query = "DELETE FROM classe WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)) or die('error delete');
    }

    public function findAll() {
        $result = array();
        $query = "SELECT * FROM classe";
        $req = $this->connexion->getConnexion()->query($query); // query # prepare
        $req->execute();
        while($e = $req->fetch(PDO::FETCH_OBJ)){
            $filiereservice = new FiliereServices();
            $filiere = $filiereservice->findById($e->id_f);
            $classe = new Classe($e->id, $e->code, $filiere);
            $temp = array(
                "id" => $classe->getId(),
                "code" => $classe->getCode(),
                "filiere" => array(
                    "id" => $classe->getfiliere()->getId(),
                    "code" => $classe->getfiliere()->getCode(),
                    "libelle" => $classe->getfiliere()->getLibelle()
                )
                );
            array_push($result, $temp);
        }
        return $result;
    }
    // function to show the classes that has the same "FILIERE"
    public function findByFiliere($filiere){
        $query = "SELECT * FROM classe WHERE classe.id_f=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($filiere->getId()));
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $filiereservice = new FiliereServices();
            $filiere = $filiereservice->findById($e->id_f);
            $classes[] = new Classe($e->id, $e->code, $filiere);
        }
        return $classes;
    }

    public function findByFiliere2($filiere){
        $result = array();
        $query = "SELECT * FROM classe WHERE classe.id_f=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($filiere->getId()));
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $filiereservice = new FiliereServices();
            $filiere = $filiereservice->findById($e->id_f);
            $classe = new Classe($e->id, $e->code, $filiere);
            $temp = array(
                "id" => $classe->getId(),
                "code" => $classe->getCode(),
                "filiere" => array(
                    "id" => $classe->getfiliere()->getId(),
                    "code" => $classe->getfiliere()->getCode(),
                    "libelle" => $classe->getfiliere()->getLibelle()
                )
            );
            array_push($result, $temp);
        }
        return $result;
    }

    public function findById($id) {
        $query = "SELECT * FROM classe WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)); 
        $f = $req->fetch(PDO::FETCH_OBJ);
        $filiereservice = new FiliereServices();
        $filiere = $filiereservice->findById($f->id_f);
        $fonction = new Classe($f->id, $f->code, $filiere);
        return $fonction;
    }


    public function update($o) {
        $query = "UPDATE classe SET code=?, id_f=? WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array( $o->getCode() , $o->getfiliere()->getId(), $o->getId()));
    }
    public function classeStats(){
        $query = "SELECT COUNT(*) AS nombre, id_f AS id FROM classe GROUP BY id_f";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $f = $req->fetchAll(PDO::FETCH_OBJ);
        $labels = array();
        $dataset = array();
        foreach($f as $e){
            $num = $e->nombre;
            $fs = new FiliereServices();
            $filiere = $fs->findById($e->id);
            $code = $filiere->getCode();
            array_push($labels, $code);
            array_push($dataset, $num);
        }
        $result = array(
            "labels" => $labels,
            "dataset" => $dataset
        );
        return json_encode($result);
    }

}
