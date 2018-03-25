<?php
require_once 'Model/PostManager.php';
require_once 'Model/CommentManager.php';
require_once 'View/View.php';

class BlogController {
    private $managerb;
    private $managerc;
    public function __construct() {
        $this->managerb = new PostManager();
        $this->managerc = new CommentManager();
    }
// Affiche la liste de tous les billets du blog
    public function accueil() {
        $billets = $this->managerb->getBillets();
        $vue = new View("home");
        $vue->generer(array('billets' => $billets));
    }
    
        // Affiche les détails sur un billet
    public function billet($idBillet) {
        $billet = $this->managerb->getBillet($idBillet);
        $commentaires = $this->managerc->getCommentaires($idBillet);
        $vue = new View("post");
        $vue->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }
    
        // Ajoute un commentaire à un billet
    public function commenter($newComment) {
        // Sauvegarde du commentaire
        $this->managerc->ajouterCommentaire($newComment);
        // Actualisation de l'affichage du billet
        $this->billet($idBillet);
    }
    
    // Signalement d'un commentaire par un utilisateur
    public function reportComment($idComment) {
        $this->managerc->signalerCommentaire($idComment);    
    }   
    
}