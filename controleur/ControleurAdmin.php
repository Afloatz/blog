<?php
require_once 'Modele/BilletsManager.php';
require_once 'Modele/CommentsManager.php';
require_once 'Vue/Vue.php';

class ControleurAdmin {
    private $managerb;
    private $managerc;
    public function __construct() {
        $this->managerb = new BilletsManager();
        $this->managerc = new CommentsManager();
    }
    
    // Affiche la liste de tous les billets et commentaires du blog
    public function admin() {
        $billets = $this->managerb->getBillets();
        $commentaires = $this->managerc->getListCommentaires();
        $vue = new Vue("Admin");
        $vue->generer(array('billets' => $billets, 'commentaires' => $commentaires));
    }
    
    // Supprime un billet
    public function delete($idBillet) {
        $this->managerb->deleteBillet($idBillet); 
        // Actualisation de l'affichage
        $this->admin();
    }
    
    // Supprime un commentaire
    public function deleteComment($idComment) {
        $this->managerc->deleteComment($idComment); 
        // Actualisation de l'affichage
        $this->admin();
    }
    
}