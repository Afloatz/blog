<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurBillet.php';
require_once 'Controleur/ControleurAdmin.php';
require_once 'Controleur/ControleurModifBillet.php';
require_once 'Controleur/ControleurModifComment.php';;
require_once 'Vue/Vue.php';
class Routeur {
    private $ctrlAccueil;
    private $ctrlBillet;
    private $ctrlAdmin;
    private $ctrlModifBillet;
    private $ctrlModifComment;
    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
        $this->ctrlAdmin = new ControleurAdmin();
        $this->ctrlModifBillet = new ControleurModifBillet();
        $this->ctrlModifComment = new ControleurModifComment();
    }
    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'billet') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->ctrlBillet->billet($idBillet);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");
                }
                else if ($_GET['action'] == 'connexion') {
                    $vue = new Vue("Connexion");
                    $vue->generer(array());
                }
                else if ($_GET['action'] == 'deconnexion') {
                    // Détruit toutes les variables de session
                    $_SESSION = array();
                    session_destroy();
                    $this->ctrlAccueil->accueil();
                }
                else if ($_GET['action'] == 'commenter') {
                    $newComment = new CommentEntity();
                    $newComment->setAuteur($_POST['auteur']);
                    $newComment->setContenu($_POST['contenu']);
                    $newComment->setBilletId($_POST['id']);
                    $this->ctrlBillet->commenter($newComment);
                }
                else if ($_GET['action'] == 'signaler') {
                    $idComment = intval($this->getParametre($_GET, 'idcomment'));
                    $idBillet = intval($this->getParametre($_GET, 'idbillet'));
                    $this->ctrlBillet->reportComment($idComment);
                    $this->ctrlBillet->billet($idBillet);
                }                  
                else if ($_GET['action'] == 'admin' AND isset($_POST['identifiant']) AND isset($_POST['mot_de_passe'])) {
                    $username = $_POST['identifiant'];
                    $password = $_POST['mot_de_passe'];
                    $this->ctrlAdmin->admin($username, $password);
                }
                // Pour revenir à la page admin qd on est déjà connecté
                //else if ($_GET['action'] == 'admin') {
                 //   $this->ctrlAdmin->admin();
               // }                
                else if ($_GET['action'] == 'suppression') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    $this->ctrlAdmin->delete($idBillet);
                }
                else if ($_GET['action'] == 'suppressionCom') {
                    $idComment = intval($this->getParametre($_GET, 'id'));
                    $this->ctrlAdmin->deleteComment($idComment);
                }                
                else if ($_GET['action'] == 'ajout') {
                    $vue = new Vue("AddBillet");
                    $vue->generer(array());
                }
                else if ($_GET['action'] == 'enregistrer') {
                    $newBillet = new BilletEntity();
                    $newBillet->setTitre($_POST['titleBillet']);
                    $newBillet->setContenu($_POST['contenu']);
                    $this->ctrlBillet->ajouter($newBillet);
                }                
                else if ($_GET['action'] == 'modification') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->ctrlModifBillet->modifbillet($idBillet);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");  
                }
                else if ($_GET['action'] == 'modificationCom') {
                    $idComment = intval($this->getParametre($_GET, 'id'));
                    if ($idComment != 0) {
                        $this->ctrlModifComment->modifcomment($idComment);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");  
                }                
                else if ($_GET['action'] == 'modifier') {
                    $titleBillet = $this->getParametre($_POST, 'titleBillet');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlModifBillet->modifier($titleBillet, $contenu, $idBillet);
                }
                else if ($_GET['action'] == 'modifierCom') {
                    $author = $this->getParametre($_POST, 'author');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idComment = $this->getParametre($_POST, 'id');
                    $this->ctrlModifComment->modifiercom($author, $contenu, $idComment);
                    // Actualisation de l'affichage -> retour à la page admin
                    $this->ctrlAdmin->admin();
                }                
                else
                    throw new Exception("Action non valide");
            }
            else {  // aucune action définie : affichage de l'accueil
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }
    // Affiche une erreur
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
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