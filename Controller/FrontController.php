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
    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'billet') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->blogCtrl->billet($idBillet);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");
                }
                else if ($_GET['action'] == 'connexion') {
                    $view = new View("login");
                    $view->generer(array());
                }
                else if ($_GET['action'] == 'deconnexion') {
                    // Détruit toutes les variables de session
                    $_SESSION = array();
                    session_destroy();
                    $this->blogCtrl->accueil();
                }
                else if ($_GET['action'] == 'commenter') {
                    $newComment = new CommentEntity();
                    $newComment->setAuteur($_POST['auteur']);
                    $newComment->setContenu($_POST['contenu']);
                    $newComment->setBilletId($_POST['id']);
                    $this->blogCtrl->commenter($newComment);
                }
                else if ($_GET['action'] == 'signaler') {
                    $idComment = intval($this->getParametre($_GET, 'idcomment'));
                    $idBillet = intval($this->getParametre($_GET, 'idbillet'));
                    $this->blogCtrl->reportComment($idComment);
                    $this->blogCtrl->billet($idBillet);
                }                  
                else if ($_GET['action'] == 'admin' AND isset($_POST['identifiant']) AND isset($_POST['mot_de_passe'])) {
                    $username = $_POST['identifiant'];
                    $password = $_POST['mot_de_passe'];
                    $this->adminCtrl->admin($username, $password);
                }
                // Pour revenir à la page admin qd on est déjà connecté
                //else if ($_GET['action'] == 'admin') {
                 //   $this->adminCtrl->admin();
               // }                
                else if ($_GET['action'] == 'suppression') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    $this->adminCtrl->delete($idBillet);
                }
                else if ($_GET['action'] == 'suppressionCom') {
                    $idComment = intval($this->getParametre($_GET, 'id'));
                    $this->adminCtrl->deleteComment($idComment);
                }                
                else if ($_GET['action'] == 'ajout') {
                    $view = new View("addPost");
                    $view->generer(array());
                }
                else if ($_GET['action'] == 'enregistrer') {
                    $newBillet = new BilletEntity();
                    $newBillet->setTitre($_POST['titleBillet']);
                    $newBillet->setContenu($_POST['contenu']);
                    $this->adminCtrl->ajouter($newBillet);
                }                
                else if ($_GET['action'] == 'modification') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->adminCtrl->modifbillet($idBillet);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");  
                }
                else if ($_GET['action'] == 'modificationCom') {
                    $idComment = intval($this->getParametre($_GET, 'id'));
                    if ($idComment != 0) {
                        $this->adminCtrl->modifcomment($idComment);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");  
                }                
                else if ($_GET['action'] == 'modifier') {
                    $titleBillet = $this->getParametre($_POST, 'titleBillet');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->adminCtrl->modifier($titleBillet, $contenu, $idBillet);
                }
                else if ($_GET['action'] == 'modifierCom') {
                    $author = $this->getParametre($_POST, 'author');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idComment = $this->getParametre($_POST, 'id');
                    $this->adminCtrl->modifiercom($author, $contenu, $idComment);
                    // Actualisation de l'affichage -> retour à la page admin
                    $this->adminCtrl->admin();
                }                
                else
                    throw new Exception("Action non valide");
            }
            else {  // aucune action définie : affichage de l'accueil
                $this->blogCtrl->accueil();
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
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }
}