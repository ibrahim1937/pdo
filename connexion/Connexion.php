<?php
class Connexion {
    private $connexion;
    
    public function __construct(){
        $host = "localhost";
        $dbname = "tpphp";
        $username = "root";
        $password = "";
        
        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $this->connexion = new PDO($dsn, $username, $password);
            // this next line accept characters that are not pure ascii
            $this->connexion->query("SET NAMES UTF8");
        } catch (Exception $ex) {
            die('Error: \n' . $ex->getMessage());
        }
    }
    
    // defining a function to get the attribute
    
    function getConnexion() {
        return $this->connexion;
    }


}
