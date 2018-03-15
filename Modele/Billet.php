<?php
require_once 'Modele/Modele.php';
require_once 'Entites/Billet.php';

class Billet extends Modele {
    /** Renvoie la liste des billets du blog
     * 
     * @return PDOStatement La liste des billets
     */
    public function getBillets() {
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
                . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
                . ' order by BIL_ID desc';
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
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
                . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
                . ' where BIL_ID=?';
        $billet = $this->executerRequete($sql, array($idBillet));
        if ($billet->rowCount() > 0)
            return $billet->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }
    
    public function deleteBillet($idBillet) {
        $sql = 'delete from T_BILLET' . ' where BIL_ID=?';
        $this->executerRequete($sql, array($idBillet)); 
    }
    
    // Modifie un billet dans la base
    public function modifierBillet(BilletEntity $billet) {
        $sql = 'update T_BILLET set BIL_TITRE=?, BIL_CONTENU=?, BIL_DATE=NOW()' . ' where BIL_ID=?';
        $this->executerRequete($sql, array(
            $billet->getTitre(),
            $billet->getContenu(),
            $billet->getId()
        ));
    }
}