<?php
require_once 'Modele/Modele.php';
require_once 'Entites/CommentEntity.php';

class CommentsManager extends Modele {
    // Renvoie la liste de tous les commentaires
    public function getListCommentaires() {
        $sql = 'select com_id as id, com_date as date,'
                . ' com_author as auteur, com_content as contenu from comments'
                . ' order by com_id desc';
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
        $sql = 'select com_id as id, com_date as date,'
                . ' com_author as auteur, com_content as contenu from comments'
                . ' where post_id=?';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        $commentsObjet = array();
        foreach ($commentaires as $commentaire) {
            $objet = new CommentEntity($commentaire);
            array_push($commentsObjet, $objet);
        }
        return $commentsObjet;
    }
    
    // Renvoie un commentaire spécifique
    public function getComment($idComment) {
        $sql = 'select com_id as id, com_date as date,'
                . ' com_author as auteur, com_content as contenu from comments'
                . ' where com_id=?';
        $commentaire = $this->executerRequete($sql, array($idComment));
        if ($commentaire->rowCount() > 0) {
            $commentaireObjet = $commentaire->fetch(); // Accès à la première ligne de résultat
            return new CommentEntity($commentaireObjet);  
        }
        else
            throw new Exception("Aucun commentaire ne correspond à l'identifiant '$idComment'");
    }
    
    // Ajoute un commentaire dans la base
    public function ajouterCommentaire(CommentEntity $comment) {
        $sql = 'insert into comments(com_date, com_author, com_content, post_id)'
            . ' values(NOW(), ?, ?, ?)';
        $this->executerRequete($sql, array(
            $comment->getAuteur(),
            $comment->getContenu(),
            $comment->getBilletID()
            ));
    }
    
    // Supprime un commentaire de la base
    public function deleteComment($idComment) {
        $sql = 'delete from comments' . ' where com_id=?';
        $this->executerRequete($sql, array($idComment));
    }
    
    // Modifie un commentaire dans la base
    public function modifierCommentaire(CommentEntity $commentaire) {
        $sql = 'update comments set com_author=?, com_content=?, com_date=NOW()' . ' where com_id=?';
        $this->executerRequete($sql, array(
            $commentaire->getAuteur(),
            $commentaire->getContenu(),
            $commentaire->getId()
        ));
    }
    
    // Signale un commentaire dans la base
    public function signalerCommentaire($idComment) {
        $sql = 'update comments set com_report=1' . ' where com_id=?';
        $this->executerRequete($sql, array($idComment));
    }
    
}