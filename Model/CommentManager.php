<?php
require_once 'Model/Model.php';
require_once 'Entity/CommentEntity.php';

class CommentManager extends Model {
    // Renvoie la liste de tous les commentaires
    public function getListCommentaires() {
        $sql = 'SELECT com_id AS id, com_date AS date,'
                . ' com_author AS auteur, com_content AS contenu FROM comments'
                . ' ORDER BY com_id DESC';
        $commentaires = $this->executeRequest($sql);
        $commentairesObjet = array();
        foreach ($commentaires AS $commentaire) {
            $objet = new CommentEntity($commentaire);
            array_push($commentairesObjet, $objet);
        }
        return $commentairesObjet;
    }
     
    // Renvoie la liste des commentaires ASsociés à un billet
    public function getCommentaires($idBillet) {
        $sql = 'SELECT com_id AS id, com_date AS date,'
                . ' com_author AS auteur, com_content AS contenu FROM comments'
                . ' WHERE post_id=?';
        $commentaires = $this->executeRequest($sql, array($idBillet));
        $commentsObjet = array();
        foreach ($commentaires AS $commentaire) {
            $objet = new CommentEntity($commentaire);
            array_push($commentsObjet, $objet);
        }
        return $commentsObjet;
    }
    
    // Renvoie un commentaire spécifique
    public function getComment($idComment) {
        $sql = 'SELECT com_id AS id, com_date AS date,'
                . ' com_author AS auteur, com_content AS contenu FROM comments'
                . ' WHERE com_id=?';
        $commentaire = $this->executeRequest($sql, array($idComment));
        if ($commentaire->rowCount() > 0) {
            $commentaireObjet = $commentaire->fetch(); // Accès à la première ligne de résultat
            return new CommentEntity($commentaireObjet);  
        }
        else
            throw new Exception("Aucun commentaire ne correspond à l'identifiant '$idComment'");
    }
    
    // Ajoute un commentaire dans la bASe
    public function ajouterCommentaire(CommentEntity $comment) {
        $sql = 'INSERT INTO comments(com_date, com_author, com_content, post_id)'
            . ' VALUES(NOW(), ?, ?, ?)';
        $this->executeRequest($sql, array(
            $comment->getAuteur(),
            $comment->getContenu(),
            $comment->getBilletID()
            ));
    }
    
    // Supprime un commentaire de la bASe
    public function deleteComment($idComment) {
        $sql = 'DELETE FROM comments' . ' WHERE com_id=?';
        $this->executeRequest($sql, array($idComment));
    }
    
    // Modifie un commentaire dans la bASe
    public function modifierCommentaire(CommentEntity $commentaire) {
        $sql = 'UPDATE comments SET com_author=?, com_content=?, com_date=NOW()' . ' WHERE com_id=?';
        $this->executeRequest($sql, array(
            $commentaire->getAuteur(),
            $commentaire->getContenu(),
            $commentaire->getId()
        ));
    }
    
    // Signale un commentaire dans la bASe
    public function signalerCommentaire($idComment) {
        $sql = 'UPDATE comments SET com_report=1' . ' WHERE com_id=?';
        $this->executeRequest($sql, array($idComment));
    }
    
}