<?php
require_once 'Modele/BilletsManager.php';
require_once 'Modele/CommentsManager.php';
require_once 'Vue/Vue.php';

class ControleurBillet {
    private $managerb;
    private $managerc;
    public function __construct() {
        $this->managerb = new BilletsManager();
        $this->managerc = new CommentsManager();
    }
    // Affiche les détails sur un billet
    public function billet($idBillet) {
        $billet = $this->managerb->getBillet($idBillet);
        $commentaires = $this->managerc->getCommentaires($idBillet);
        $vue = new Vue("Billet");
        $vue->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }
    // Ajoute un commentaire à un billet
    public function commenter($auteur, $contenu, $idBillet) {
        // Sauvegarde du commentaire
        $this->managerc->ajouterCommentaire($auteur, $contenu, $idBillet);
        // Actualisation de l'affichage du billet
        $this->billet($idBillet);
    }
}