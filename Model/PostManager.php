<?php
require_once 'Model/Model.php';
require_once 'Entity/PostEntity.php';

class PostManager extends Model {
    /** Renvoie la liste des billets du blog
     * 
     * @return PDOStatement La liste des billets
     */
    public function getPosts() {
        $sql = 'SELECT post_id AS id, post_date AS date,'
                . ' post_title AS titre, post_content AS contenu FROM posts'
                . ' ORDER BY post_id DESC';
        $posts = $this->executeRequest($sql);
        $postsObject = array();
        foreach ($posts as $post){
            $object = new PostEntity($post);
            array_push($postsObject, $object);

        }

        return $postsObject;
    }
    /** Renvoie les informations sur un billet
     * 
     * @param int $id L'identifiant du billet
     * @return array Le billet
     * @throws Exception Si l'identifiant du billet est inconnu
     */
    public function getPost($postId) {
        $sql = 'SELECT post_id AS id, post_date AS date,'
                . ' post_title AS titre, post_content AS contenu FROM posts'
                . ' WHERE post_id=?';
        $post = $this->executeRequest($sql, array($postId));
        if ($post->rowCount() > 0) {
            $postObject = $post->fetch(); // Accès à la première ligne de résultat
            return new PostEntity($postObject);  
        }
        else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }
    
    public function delete($postId) {
        $sql = 'delete from posts' . ' where post_id=?';
        $this->executeRequest($sql, array($postId)); 
    }
    
    // Modifie un billet dans la base
    public function update(PostEntity $post) {
        $sql = 'update posts set post_title=?, post_content=?, post_date=NOW()' . ' where post_id=?';
        $this->executeRequest($sql, array(
            // Pourquoi on utilise get et pas set?
            $post->getTitre(),
            $post->getContenu(),
            $post->getId()
        ));
    }
    
    // Ajoute un nouveau billet dans la base
    public function add(PostEntity $post) {
        $sql = 'INSERT INTO posts(post_date, post_title, post_content)' . ' values(NOW(), ?, ?)';
        $this->executeRequest($sql, array(
            $post->getTitre(),
            $post->getContenu()
            ));
    }
}