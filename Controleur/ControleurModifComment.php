<?php
require_once 'Modele/CommentsManager.php';
require_once 'Vue/Vue.php';

class ControleurModifComment {
    private $managerc;
    public function __construct() {
        $this->managerc = new CommentsManager();
    }
    
    // Affiche le commentaire à modifier
    public function modifcomment($idComment) {
        $commentaire = $this->managerc->getComment($idComment);
        $vue = new Vue("ModifCom");
        $vue->generer(array('commentaire' => $commentaire));
    }
    
    // Modifie le commentaire
    public function modifiercom($author, $contenu, $idComment) {
        // Sauvegarde du commentaire modifié
        $this->managerc->modifierCommentaire($author, $contenu, $idComment);
    }
}