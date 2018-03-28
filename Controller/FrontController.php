<?php
require_once 'Controller/BlogController.php';
require_once 'Controller/AdminController.php';
require_once 'View/View.php';

class FrontController {
    private $blogCtrl;
    private $adminCtrl;
    
    public function __construct() {
        $this->blogCtrl = new BlogController();
        $this->adminCtrl = new AdminController();
    }
    
    // Route une requête entrante : exécute l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'post') {
                    $postId = intval($this->getParameter($_GET, 'id'));
                    if ($postId != 0) {
                        $this->blogCtrl->post($postId);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");
                }
                else if ($_GET['action'] == 'login') {
                    $view = new View("login");
                    $view->generer(array());
                }
                else if ($_GET['action'] == 'logout') {
                    // Détruit toutes les variables de session
                    $_SESSION = array(); // A mettre ici ou dans le contrôleur?
                    session_destroy();
                    $this->blogCtrl->listPosts();
                }
                else if ($_GET['action'] == 'addComment') { // Ne fonctionne pas
                    $author = $this->getParameter($_POST, 'author');
                    $content = $this->getParameter($_POST, 'content');
                    $postId = $this->getParameter($_POST, 'id');
                    $this->blogCtrl->addComment($author, $content, $postId);                    
                }
                else if ($_GET['action'] == 'reportComment') {
                    $commentId = intval($this->getParameter($_GET, 'commentId'));
                    $postId = intval($this->getParameter($_GET, 'postId'));
                    $this->blogCtrl->reportComment($commentId);
                }                  
                else if ($_GET['action'] == 'admin') {
                    $username = $this->getParameter($_POST, 'username');
                    $password = $this->getParameter($_POST, 'password');
                    $this->adminCtrl->admin($username, $password);
                }
                
                // Pour revenir à la page admin qd on est déjà connecté
                //else if ($_GET['action'] == 'admin') {
                 //   $this->adminCtrl->admin();
               // }                
                else if ($_GET['action'] == 'deletePost') {
                    $postId = intval($this->getParameter($_GET, 'id'));
                    $this->adminCtrl->deletePost($postId);
                }
                else if ($_GET['action'] == 'deleteComment') {
                    $commentId = intval($this->getParameter($_GET, 'id'));
                    $this->adminCtrl->deleteComment($commentId);
                }                
                else if ($_GET['action'] == 'addPost') {
                    //Est-ce que je génère la vue ici ou dans AdminController?
                    $view = new View("addPost");
                    $view->generer(array());
                }
                else if ($_GET['action'] == 'saveNewPost') {
                    $title = $this->getParameter($_POST, 'title');
                    $content = $this->getParameter($_POST, 'content');
                    $this->adminCtrl->addPost($title, $content);                    
                }
                else if ($_GET['action'] == 'editPost') {
                    $postId = intval($this->getParameter($_GET, 'id'));
                    if ($postId != 0) {
                        $this->adminCtrl->editPost($postId);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");  
                }
                else if ($_GET['action'] == 'editComment') {
                    $commentId = intval($this->getParameter($_GET, 'id'));
                    if ($commentId != 0) {
                        $this->adminCtrl->editComment($commentId);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");  
                }                
                else if ($_GET['action'] == 'updatePost') {
                    $title = $this->getParameter($_POST, 'title');
                    $content = $this->getParameter($_POST, 'content');
                    $postId = $this->getParameter($_POST, 'id');
                    $this->adminCtrl->updatePost($title, $content, $postId);
                }
                else if ($_GET['action'] == 'updateComment') {
                    $author = $this->getParameter($_POST, 'author');
                    $content = $this->getParameter($_POST, 'content');
                    $commentId = $this->getParameter($_POST, 'id');
                    $this->adminCtrl->updateComment($author, $content, $commentId);
                }
                else if ($_GET['action'] == 'adminComments') {
                    $this->adminCtrl->adminComments();
                }                
                else
                    throw new Exception("Action non valide");
            }
            else {  // aucune action définie : affichage de l'accueil
                $this->blogCtrl->listPosts();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }
    
    // Affiche une erreur
    private function erreur($msgErreur) {
        $view = new View("error");
        $view->generer(array('msgErreur' => $msgErreur));
    }
    
    // Recherche un paramètre dans un tableau
    private function getParameter($array, $name) {
        if (isset($array[$name])) {
            return $array[$name];
        }
        else
            throw new Exception("Paramètre '$name' absent");
    }
}