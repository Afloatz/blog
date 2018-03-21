<?php
require_once 'Modele/BilletsManager.php';
require_once 'Modele/CommentsManager.php';
require_once 'Modele/SessionManager.php';
require_once 'Vue/Vue.php';

class ControleurAdmin {
    private $managerb;
    private $managerc;
    private $managers;
    public function __construct() {
        $this->managerb = new BilletsManager();
        $this->managerc = new CommentsManager();
        $this->managers = new SessionManager();
    }
    
    // Affiche la liste de tous les billets et commentaires du blog
    public function admin($username, $password) {
        $this->managers->login($username, $password);
        
        if (password_verify($_POST['mot_de_passe'], $user->password)) {
            $_SESSION['auth'] = $user;
            $billets = $this->managerb->getBillets();
            $commentaires = $this->managerc->getListCommentaires();
            $vue = new Vue("Admin");
            $vue->generer(array('billets' => $billets, 'commentaires' => $commentaires));            
        } else {
            $vue = new Vue("Connexion");
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