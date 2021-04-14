<?php

class Users {
    //declaring private properties

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    function __construct($id, $nom, $prenom, $email, $password) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
    }
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getEmail() {
        return $this->email;
    }

    // TODO check if i should use the get methode here
    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    // TODO check if i should use this method
    function setPassword($password) {
        $this->password = $password;
    }


    
}
