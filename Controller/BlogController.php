<?php
require_once 'Entity/CommentEntity.php';
require_once 'Model/PostManager.php';
require_once 'Model/CommentManager.php';
require_once 'View/View.php';

class BlogController {
    private $postManager;
    private $commentManager;
    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }
    
    // Affiche la liste de tous les billets du blog
    public function listPosts() {
        $posts = $this->postManager->getPosts();
        $view = new View("home");
        $view->generer(array('posts' => $posts));
    }
    
    // Affiche les détails sur un billet
    public function post($postId) {
        $post = $this->postManager->getPost($postId);
        $comments = $this->commentManager->getComments($postId);
        $view = new View("post");
        $view->generer(array('post' => $post, 'comments' => $comments));
    }
    
    // Ajoute un commentaire à un billet
    public function addComment($author, $content, $postId) {
        $comment = new CommentEntity(array('auteur' => $author, 'contenu' => $content, 'postid' => $postId));
        // Sauvegarde du commentaire
        $this->commentManager->postComment($comment);
        //Comment actualiser la vue?
    }
    
    // Signalement d'un commentaire par un utilisateur
    public function reportComment($commentId) {
        $this->commentManager->report($commentId);  
        //Comment réactualiser la page?
    }   
    
}