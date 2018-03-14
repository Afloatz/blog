<?php
require_once 'Modele/Billet.php';
require_once 'Vue/Vue.php';

class ControleurAdmin {
    private $billet;
    public function __construct() {
        $this->billet = new Billet();
    }
    // Affiche la liste de tous les billets du blog
    public function admin() {
        $billets = $this->billet->getBillets();
        $vue = new Vue("Admin");
        $vue->generer(array('billets' => $billets));
    }
    // Supprime un billet
    public function delete($idBillet) {
        $this->billet->deleteBillet($idBillet); 
        // Actualisation de l'affichage
        $this->admin();
    }
    
}