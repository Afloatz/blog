<?php
require_once 'Model/PostManager.php';
require_once 'View/View.php';
class ControleurAccueil {
    private $managerb;
    public function __construct() {
        $this->managerb = new PostManager();
    }
// Affiche la liste de tous les billets du blog
    public function accueil() {
        $billets = $this->managerb->getBillets();
        $vue = new View("home");
        $vue->generer(array('billets' => $billets));
    }
}