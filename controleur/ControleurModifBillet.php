<?php
require_once 'Modele/Billet.php';
require_once 'Vue/Vue.php';

class ControleurModifBillet {
    private $billet;
    public function __construct() {
        $this->billet = new Billet();
    }
    // Affiche le billet à modifier
    public function modifbillet($idBillet) {
        $billet = $this->billet->getBillet($idBillet);
        $vue = new Vue("ModifBillet");
        $vue->generer(array('billet' => $billet));
    }
}