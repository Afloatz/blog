<?php $this->titre = "Page de connexion"; ?>


<header>
        <h1 >Page de connexion</h1>
</header>

   
<form method="post" action="index.php?action=admin">
    <input type="text" name="login" />
    <input type="password" name="mot_de_passe" />
    <input type="submit" value="Se connecter" />
</form>
