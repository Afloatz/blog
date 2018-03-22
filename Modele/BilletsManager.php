<?php
require_once 'Modele/Modele.php';
require_once 'Entites/BilletEntity.php';

class BilletsManager extends Modele {
    /** Renvoie la liste des billets du blog
     * 
     * @return PDOStatement La liste des billets
     */
    public function getBillets() {
        $sql = 'SELECT post_id AS id, post_date AS date,'
                . ' post_title AS titre, post_content AS contenu FROM posts'
                . ' ORDER BY post_id DESC';
        $billets = $this->executerRequete($sql);
        $billetsObjet = array();
        foreach ($billets as $billet){
            $objet = new BilletEntity($billet);
            array_push($billetsObjet, $objet);

        }

        return $billetsObjet;
    }
    /** Renvoie les informations sur un billet
     * 
     * @param int $id L'identifiant du billet
     * @return array Le billet
     * @throws Exception Si l'identifiant du billet est inconnu
     */
    public function getBillet($idBillet) {
        $sql = 'select post_id as id, post_date as date,'
                . ' post_title as titre, post_content as contenu from posts'
                . ' where post_id=?';
        $billet = $this->executerRequete($sql, array($idBillet));
        if ($billet->rowCount() > 0) {
            $billetObjet = $billet->fetch(); // Accès à la première ligne de résultat
            return new BilletEntity($billetObjet);  
        }
        else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }
    
    public function deleteBillet($idBillet) {
        $sql = 'delete from posts' . ' where post_id=?';
        $this->executerRequete($sql, array($idBillet)); 
    }
    
    // Modifie un billet dans la base
    public function modifierBillet(BilletEntity $billet) {
        $sql = 'update posts set post_title=?, post_content=?, post_date=NOW()' . ' where post_id=?';
        $this->executerRequete($sql, array(
            $billet->getTitre(),
            $billet->getContenu(),
            $billet->getId()
        ));
    }
    
    // Ajoute un nouveau billet dans la base
    public function ajouterBillet(BilletEntity $billet) {
        $sql = 'insert into posts(post_date, post_title, post_content)'
            . ' values(NOW(), ?, ?)';
        $this->executerRequete($sql, array(
            $billet->getTitre(),
            $comment->getContenu()
            ));
    }
}