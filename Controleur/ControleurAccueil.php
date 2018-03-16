<?php
require_once 'Modele/BilletsManager.php';
require_once 'Vue/Vue.php';
class ControleurAccueil {
    private $managerb;
    public function __construct() {
        $this->managerb = new BilletsManager();
    }
// Affiche la liste de tous les billets du blog
    public function accueil() {
        $billets = $this->managerb->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }
}