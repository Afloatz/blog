<?php
require_once 'Entity/PostEntity.php';
require_once 'Model/PostManager.php';
require_once 'Model/CommentManager.php';
require_once 'Model/AdminManager.php';
require_once 'View/View.php';

class AdminController {
    private $postManager;
    private $commentManager;
    private $adminManager;
    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->adminManager = new AdminManager();
    }
    
    // Affiche la page d'administration si username et password corrects
    public function admin($username, $password) {
        // Récupération du nom d'utilisateur et mot de passe ds la bdd si utilisateur entré est correct
        $user = $this->adminManager->login($username);
        // On vérifie que le mot de passe entré correspond au mot de passe haché récupéré ds la bdd
        if (password_verify($password, $user['password'])) {
            $_SESSION['auth'] = $user;
            $posts = $this->postManager->getPosts();
            // Vérifie si des commentaires ont été signalé
            $sum = $this->commentManager->getSum();
            $_SESSION['sum'] = $sum;
            $view = new View("admin");
            $view->generer(array('posts' => $posts));          
        } else {
            $view = new View("login");
            $view->generer(array());
        }       
    }
    
    // Comment restreindre également l'accès à cette page?
    public function adminComments() {
        // Vérifie si des commentaires ont été signalé
        $sum = $this->commentManager->getSum();
        $_SESSION['sum'] = $sum;  
        
        // Vérifie s'il y a des commentaires non signalé
        $min = $this->commentManager->getMin();
        $_SESSION['min'] = $min;   
        
        $comments = $this->commentManager->getListComments();
        $view = new View("adminComments");
        $view->generer(array('comments' => $comments));          
    }
    
    // Supprime un billet
    public function deletePost($postId) {
        $this->postManager->delete($postId); 
        // Actualisation de l'affichage
        $this->admin(); // Ne fonctionne pas car pas d'argument -> actualiser la vue dans le FrontController ou ici?
    }
    
    // Supprime un commentaire
    public function deleteComment($commentId) {
        $this->commentManager->delete($commentId); 
        // Actualisation de l'affichage qui ne fonctionne pas
        $this->admin();
    }
    
    // Ajouter un billet
    public function addPost($title, $content) {
        $post = new PostEntity(array('titre' => $title, 'contenu' => $content));
        // Sauvegarde du billet
        $this->postManager->add($post);
    }
    
    // Affiche le billet à modifier
    public function editPost($postId) {
        $post = $this->postManager->getPost($postId);
        $view = new View("editPost");
        $view->generer(array('post' => $post));
    }
    
    // Modifie le billet
    public function updatePost($title, $content, $postId) {
        $post = new PostEntity(array('id' => $postId, 'titre' => $title, 'contenu' => $content));
        // Sauvegarde du billet modifié
        $this->postManager->update($post);
        //Comment actualiser la vue?
    }
    
    // Affiche le commentaire à modifier
    public function editComment($commentId) {
        $comment = $this->commentManager->getComment($commentId);
        $view = new View("editComment");
        $view->generer(array('comment' => $comment));
    }
    
    // Modifie le commentaire
    public function updateComment($author, $content, $commentId) {
        $comment = new CommentEntity(array('id' => $commentId, 'auteur' => $author, 'contenu' => $content));
        // Sauvegarde du commentaire modifié
        $this->commentManager->update($comment);
    }
}