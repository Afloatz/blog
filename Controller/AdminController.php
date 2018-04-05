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
        sleep(1); // Pause de 1 seconde avt de se connecter pour ralentir attaque par force brute
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
            // On reste sur la page de connexion si paramètres d'authentification non correct
            $view = new View("login");
            $view->generer(array());
        }  
    }
    
    public function adminReturn() {
        $posts = $this->postManager->getPosts();
        $view = new View("admin");
        $view->generer(array('posts' => $posts));  
    }
    
    public function adminComments() {
        // On vérifie que la session existe avant de lancer la fonction
        if (isset($_SESSION['auth'])) {
            // Vérifie si des commentaires ont été signalé
            $sum = $this->commentManager->getSum();
            $_SESSION['sum'] = $sum;  

            // Vérifie s'il y a des commentaires non signalé
            $min = $this->commentManager->getMin();
            $_SESSION['min'] = $min;   

            $comments = $this->commentManager->getListComments();
            $view = new View("adminComments");
            $view->generer(array('comments' => $comments));
        } else { // Si la variable de session n'existe pas on redirige vers la page de connexion
            $view = new View("login");
            $view->generer(array());          
        }
    }
    
    // Supprime un billet
    public function deletePost($postId) {
        if (isset($_SESSION['auth'])) {
            $this->postManager->delete($postId);
            // Renvoie à la page d'administration
            $this->adminReturn();
        } else {
            $view = new View("login");
            $view->generer(array());  
        }
    }
    
    // Supprime un commentaire
    public function deleteComment($commentId) {
        if (isset($_SESSION['auth'])) {
            $this->commentManager->delete($commentId);
            // Renvoie à la page d'administration des commentaires
            $this->adminComments();
        } else {
            $view = new View("login");
            $view->generer(array());  
        }
    }
    
    // Ajouter un billet
    public function addPost($title, $content) {
        if (isset($_SESSION['auth'])) {
            $post = new PostEntity(array('titre' => $title, 'contenu' => $content));
            // Sauvegarde du billet
            $this->postManager->add($post);
            // Renvoie à la page d'administration
            $this->adminReturn();
        } else {
            $view = new View("login");
            $view->generer(array()); 
        }
    }
    
    // Affiche le billet à modifier
    public function editPost($postId) {
        if (isset($_SESSION['auth'])) {
            $post = $this->postManager->getPost($postId);
            $view = new View("editPost");
            $view->generer(array('post' => $post));
        } else {
            $view = new View("login");
            $view->generer(array());
        }
    }
    
    // Modifie le billet
    public function updatePost($title, $content, $postId) {
        if (isset($_SESSION['auth'])) {
            $post = new PostEntity(array('id' => $postId, 'titre' => $title, 'contenu' => $content));
            // Sauvegarde du billet modifié
            $this->postManager->update($post);
            // Renvoie à la page d'administration
            $this->adminReturn();
        } else {
            $view = new View("login");
            $view->generer(array()); 
        }
    }
    
    // Affiche le commentaire à modifier
    public function editComment($commentId) {
        if (isset($_SESSION['auth'])) {
            $comment = $this->commentManager->getComment($commentId);
            $view = new View("editComment");
            $view->generer(array('comment' => $comment));
        } else {
            $view = new View("login");
            $view->generer(array()); 
        }
    }
    
    // Modifie le commentaire
    public function updateComment($author, $content, $commentId) {
        if (isset($_SESSION['auth'])) {
            $comment = new CommentEntity(array('id' => $commentId, 'auteur' => $author, 'contenu' => $content));
            // Sauvegarde du commentaire modifié
            $this->commentManager->update($comment);
            // Renvoie à la page d'administration des commentaires
            $this->adminComments();
        } else {
            $view = new View("login");
            $view->generer(array()); 
        }
    }
}