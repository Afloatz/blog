<?php
require_once 'Model/PostManager.php';
require_once 'Entity/PostEntity.php';
require_once 'View/View.php';

class ControleurModifBillet {
    private $managerb;
    public function __construct() {
        $this->managerb = new PostManager();
    }
    // Affiche le billet à modifier
    public function modifbillet($idBillet) {
        $billet = $this->managerb->getBillet($idBillet);
        $vue = new View("updatePost");
        $vue->generer(array('billet' => $billet));
    }
    // Modifie le billet
    public function modifier($titleBillet, $contenu, $idBillet) {
        $billet = new PostEntity(array("id"=>$idBillet, "titre"=>$titleBillet, "contenu"=>$contenu));
        // Sauvegarde du billet modifié
        $this->managerb->modifierBillet($billet);
    }
}