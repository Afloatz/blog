<?php
require_once 'Model/Model.php';
require_once 'Entity/CommentEntity.php';

class CommentManager extends Model {
    
    // Renvoie la liste de tous les commentaires
    public function getListComments() {
        $sql = 'SELECT com_id AS id, com_date AS date,'
                . ' com_author AS auteur, com_content AS contenu, com_report AS report, post_id AS postid FROM comments'
                . ' ORDER BY com_id DESC';
        $comments = $this->executeRequest($sql);
        $commentsObject = array();
        foreach ($comments AS $comment) {
            $object = new CommentEntity($comment);
            array_push($commentsObject, $object);
        }
        return $commentsObject;
    }
     
    // Renvoie la liste des commentaires ASsociés à un billet
    public function getComments($postId) {
        $sql = 'SELECT com_id AS id, com_date AS date,'
                . ' com_author AS auteur, com_content AS contenu FROM comments'
                . ' WHERE post_id=?';
        $comments = $this->executeRequest($sql, array($postId));
        $commentsObject = array();
        foreach ($comments AS $comment) {
            $object = new CommentEntity($comment);
            array_push($commentsObject, $object);
        }
        return $commentsObject;
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
    
    // Ajoute un commentaire dans la base
    public function postComment(CommentEntity $comment) {
        $sql = 'INSERT INTO comments(com_date, com_author, com_content, post_id)'
            . ' VALUES(NOW(), ?, ?, ?)';
        $this->executeRequest($sql, array(
            $comment->getAuteur(),
            $comment->getContenu(),
            $comment->getPostId()
            ));
    }
    
    // Supprime un commentaire de la base
    public function delete($commentId) {
        $sql = 'DELETE FROM comments' . ' WHERE com_id=?';
        $this->executeRequest($sql, array($commentId));
    }
    
    // Modifie un commentaire dans la base
    public function update(CommentEntity $comment) {
        $sql = 'UPDATE comments SET com_author=?, com_content=?, com_date=NOW()' . ' WHERE com_id=?';
        $this->executeRequest($sql, array(
            $comment->getAuteur(),
            $comment->getContenu(),
            $comment->getId()
        ));
    }
    
    // Signale un commentaire dans la base
    public function report($commentId) {
        $sql = 'UPDATE comments SET com_report=1' . ' WHERE com_id=?';
        $this->executeRequest($sql, array($commentId));
    }
    
    // Calcule la somme des valeurs de la colonne com_report
    public function getSum() {
        $sql = 'SELECT SUM(com_report)' . ' FROM comments';
        $req = $this->executeRequest($sql);
        $result = $req->fetch(); // renvoie la 1ère ligne 
        $sum = $result[0]; // Stocke le résultat dans une variable (une seule ligne)
        return $sum;
    }
    
}