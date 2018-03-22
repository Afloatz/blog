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
        $sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
                . ' where COM_ID=?';
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
        $sql = 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, post_id)'
            . ' values(NOW(), ?, ?, ?)';
        $this->executerRequete($sql, array(
            $comment->getAuteur(),
            $comment->getContenu(),
            $comment->getBilletID()
            ));
    }
    
    // Supprime un commentaire de la base
    public function deleteComment($idComment) {
        $sql = 'delete from T_COMMENTAIRE' . ' where COM_ID=?';
        $this->executerRequete($sql, array($idComment));
    }
    
    // Modifie un commentaire dans la base
    public function modifierCommentaire(CommentEntity $commentaire) {
        $sql = 'update T_COMMENTAIRE set COM_AUTEUR=?, COM_CONTENU=?, COM_DATE=NOW()' . ' where COM_ID=?';
        $this->executerRequete($sql, array(
            $commentaire->getAuteur(),
            $commentaire->getContenu(),
            $commentaire->getId()
        ));
    }
    
    // Signale un commentaire dans la base
    public function signalerCommentaire($idComment) {
        $sql = 'update T_COMMENTAIRE set COM_SIGNALE=1' . ' where COM_ID=?';
        $this->executerRequete($sql, array($idComment));
    }
    
}