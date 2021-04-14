<?php

require 'Filiere.php';

class Classe {
    
    private $id;
    private $code;
    private $filiere;
    
    function __construct($id, $code, $filiere) {
        $this->id = $id;
        $this->code = $code;
        $this->filiere = $filiere;
    }
    
    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getfiliere() {
        return $this->filiere;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setfiliere($filiere) {
        $this->filiere = $filiere;
    }





}
