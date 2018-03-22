<?php
require_once 'Modele/BilletsManager.php';
require_once 'Entites/BilletEntity.php';
require_once 'Vue/Vue.php';

class ControleurModifBillet {
    private $managerb;
    public function __construct() {
        $this->managerb = new BilletsManager();
    }
    // Affiche le billet à modifier
    public function modifbillet($idBillet) {
        $billet = $this->managerb->getBillet($idBillet);
        $vue = new Vue("ModifBillet");
        $vue->generer(array('billet' => $billet));
    }
    // Modifie le billet
    public function modifier($titleBillet, $contenu, $idBillet) {
        $billet = new BilletEntity(array("id"=>$idBillet, "titre"=>$titleBillet, "contenu"=>$contenu));
        // Sauvegarde du billet modifié
        $this->managerb->modifierBillet($billet);
    }
}