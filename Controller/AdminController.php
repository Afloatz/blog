<?php
require_once 'Entity/PostEntity.php';
require_once 'Model/PostManager.php';
require_once 'Model/CommentManager.php';
require_once 'Model/AdminManager.php';
require_once 'View/View.php';

class AdminController {
    private $managerb;
    private $managerc;
    private $managers;
    public function __construct() {
        $this->managerb = new PostManager();
        $this->managerc = new CommentManager();
        $this->managers = new AdminManager();
    }
    
    // Affiche la liste de tous les billets et commentaires du blog
    public function admin($username, $password) {
        $user = $this->managers->login($username, $password);
        
        if ($user != null) {
           $_SESSION['auth'] = $user;
            $billets = $this->managerb->getBillets();
            $commentaires = $this->managerc->getListCommentaires();
            $vue = new View("admin");
            $vue->generer(array('billets' => $billets, 'commentaires' => $commentaires));          
        } else {
            $vue = new View("login");
            $vue->generer(array());
        }       
    }
    
    // Supprime un billet
    public function delete($idBillet) {
        $this->managerb->deleteBillet($idBillet); 
        // Actualisation de l'affichage
        $this->admin();
    }
    
    // Supprime un commentaire
    public function deleteComment($idComment) {
        $this->managerc->deleteComment($idComment); 
        // Actualisation de l'affichage
        $this->admin();
    }
    
    public function connection($username, $password) {
        $this->managers->login($username, $password);
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = $user;
        }
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
    
        // Affiche le commentaire à modifier
    public function modifcomment($idComment) {
        $commentaire = $this->managerc->getComment($idComment);
        $vue = new View("updateCom");
        $vue->generer(array('commentaire' => $commentaire));
    }
    
    // Modifie le commentaire
    public function modifiercom($author, $contenu, $idComment) {
        // Sauvegarde du commentaire modifié
        $this->managerc->modifierCommentaire($author, $contenu, $idComment);
    }
}