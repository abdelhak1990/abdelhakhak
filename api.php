<?php

header('Content-Type: application/json');

class Personnage {
    // Properties
    public $id;
    public $nom;
    public $prenom;
    public $role;
    public $photo;

    function __construct($id, $nom, $prenom, $role, $photo) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->role = $role;
        $this->photo = $photo;
    }

    // Methods
    function get_id() {
        return $this->id;
    }

    function set_name($name) {
        $this->nom = $name;
    }
    function get_name() {
        return $this->nom;
    }

    function set_prenom($val) {
        $this->prenom = $val;
    }
    function get_prenom() {
        return $this->prenom;
    }

    function set_role($val) {
        $this->role = $val;
    }
    function get_role() {
        return $this->role;
    }

    function set_photo($val) {
        $this->photo = $val;
    }
    function get_photo() {
        return $this->photo;
    }

}

$vito = new Personnage(1 ,'CORLEONE', 'Vito', 'Le parin', 'vito');
$mick = new Personnage(2 ,'CORLEONE', 'Michael', 'Successeur', 'mick');
$thom = new Personnage(3 ,'CORLEONE', 'Tom Hagen', 'Avocat', 'tom');
$federico = new Personnage(4 ,'CORLEONE', 'Federico', 'Gerant Hotel', 'fede');

$personnages = [$vito,$mick,$thom,$federico];

echo json_encode($personnages, JSON_PRETTY_PRINT);



