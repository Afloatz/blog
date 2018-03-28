<?php $this->titre = "Page de connexion"; ?>



<h1 >Connexion à l'espace d'administration</h1>


<?php if(!isset($_SESSION['auth']) AND $_GET['action'] == 'admin'): ?>
    <p>Identifiant ou mot de passe non valide</p>
    <p>Veuillez ressaisir votre identifiant et mot de passe</p>
<?php endif; ?>
               		

   
<form id="form_connexion" method="post" action="index.php?action=admin">
    <p><input type="text" name="username" /></p>
    <p><input type="password" name="password" /></p>
    <p><input type="submit" value="Se connecter" /></p>
</form>
