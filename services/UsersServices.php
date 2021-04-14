<?php


include_once 'connexion/Connexion.php';
include_once 'beans/Users.php';
include_once 'dao/IDao.php';

class UsersServices implements IDao {
    
    // we need a connection
    private $connexion;
    
    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        $query = "INSERT INTO users VALUES (NULL,?,?,?,?)";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($o->getNom(),$o->getPrenom(), $o->getEmail(), $o->getPassword() )) or die('Error');
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)) or die('error delete');   
    }

    public function findAll() {
        $query = "SELECT * FROM users";
        $req = $this->connexion->getConnexion()->query($query); // query # prepare
        $f = $req->fetchAll(PDO::FETCH_OBJ);
        return $f;
    }

    public function findById($id) {
        $query = "SELECT * FROM users WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)); 
        $f = $req->fetch(PDO::FETCH_OBJ);
        $fonction = new Users($f->id, $f->nom, $f->prenom, $f->email, $f->pass);
        return $fonction;

    }

    // returns the id if the email exists otherwise returns -1
    public function findByEmail($email){
        $query = "SELECT * FROM users WHERE email=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($email));
        $s = $req->fetchAll(PDO::FETCH_OBJ);
        // We must check if the email provided is in the database or not
        // otherwise it must at least be one email
        if(count($s) != 0){
            // the email exists 
            foreach($s as $res){
                $id = $res->id;
                return $id;
            }
        } else {
            return -1;
        }
    }

    public function findByIdApi($id){
        $query = "SELECT * FROM users WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($id)); 
        $f = $req->fetch(PDO::FETCH_OBJ);
        return $f;
  
    }

    public function update($o) {
        $query = "UPDATE users SET nom=?, prenom=?, email=?, pass=? WHERE id=?";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array($o-getNom(), $o->getPrenom(), $o->getEmail(), $o->getPassword()));
    }

}
