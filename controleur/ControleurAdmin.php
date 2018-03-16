<?php
require_once 'Modele/BilletsManager.php';
require_once 'Vue/Vue.php';

class ControleurAdmin {
    private $managerb;
    public function __construct() {
        $this->managerb = new BilletsManager();
    }
    // Affiche la liste de tous les billets du blog
    public function admin() {
        $billets = $this->managerb->getBillets();
        $vue = new Vue("Admin");
        $vue->generer(array('billets' => $billets));
    }
    // Supprime un billet
    public function delete($idBillet) {
        $this->managerb->deleteBillet($idBillet); 
        // Actualisation de l'affichage
        $this->admin();
    }
    
}