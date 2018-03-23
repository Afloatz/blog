<?php
require_once 'Model/CommentManager.php';
require_once 'View/View.php';

class ControleurModifComment {
    private $managerc;
    public function __construct() {
        $this->managerc = new CommentManager();
    }
    
    // Affiche le commentaire à modifier
    public function modifcomment($idComment) {
        $commentaire = $this->managerc->getComment($idComment);
        $vue = new View("updateCom");
        $vue->generer(array('commentaire' => $commentaire));
    }
    
    // Modifie le commentaire
    public function modifiercom($author, $contenu, $idComment) {
        // Sauvegarde du commentaire modifié
        $this->managerc->modifierCommentaire($author, $contenu, $idComment);
    }
}