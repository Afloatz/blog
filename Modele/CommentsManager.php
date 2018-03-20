<?php
require_once 'Modele/Modele.php';
require_once 'Entites/CommentEntity.php';

class CommentsManager extends Modele {
    // Renvoie la liste de tous les commentaires
    public function getListCommentaires() {
        $sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
                . ' order by COM_ID desc';
        $commentaires = $this->executerRequete($sql);
        $commentairesObjet = array();
        foreach ($commentaires as $commentaire) {
            $objet = new CommentEntity($commentaire);
            array_push($commentairesObjet, $objet);
        }
        return $commentairesObjet;
    }
    
    
    // Renvoie la liste des commentaires associés à un billet
    public function getCommentaires($idBillet) {
        $sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
                . ' where BIL_ID=?';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        $commentsObjet = array();
        foreach ($commentaires as $commentaire) {
            $objet = new CommentEntity($commentaire);
            array_push($commentsObjet, $objet);
        }
        return $commentsObjet;
    }
    // Ajoute un commentaire dans la base
    public function ajouterCommentaire(CommentEntity $comment) {
        $sql = 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' values(NOW(), ?, ?, ?)';
        $this->executerRequete($sql, array(
            $comment->getAuteur(),
            $comment->getContenu(),
            $comment->getBilletID()
            ));
    }
}