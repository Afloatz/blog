<?php $this->titre = "Mon Blog - " . $billet['titre']; ?>
<?php $this->script1 = "https://cloud.tinymce.com/stable/tinymce.min.js"; ?>
<?php $this->script2 = "tinymce.init({ selector:'textarea' });"; ?>

<article>
    <header>
        <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
        <time><?= $billet['date'] ?></time>
    </header>
    <p><?= $billet['contenu'] ?></p>
</article>
<hr />
<header>
    <h1 id="titreReponses">Modifier le billet <?= $billet['titre'] ?></h1>
</header>
<hr />
<form method="post" action="index.php?action=modifier">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <input id="titleBillet" name="titleBillet" type="text" /><br />
    <textarea id="txtBillet" name="contenu" rows="4"></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Sauvegarder" />
</form>