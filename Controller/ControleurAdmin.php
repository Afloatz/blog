<?php
require_once 'Model/PostManager.php';
require_once 'Model/CommentManager.php';
require_once 'Model/AdminManager.php';
require_once 'View/View.php';

class ControleurAdmin {
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
}