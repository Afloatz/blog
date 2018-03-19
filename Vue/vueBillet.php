<?php $this->titre = "Mon Blog - " . $billet->getTitre(); ?>

<article>
    <header>
        <h1 class="titreBillet"><?= $billet->getTitre() ?></h1>
        <time><?= $billet->getDate() ?></time>
    </header>
    <p><?= $billet->getContenu() ?></p>
</article>
<hr />
<header>
    <h1 id="titreReponses">Réponses à <?= $billet->getTitre() ?></h1>
</header>
<?php foreach ($commentaires as $commentaire): ?>
    <p><?= $commentaire->getAuteur() ?> dit :</p>
    <p><?= $commentaire->getContenu() ?></p>
<?php endforeach; ?>
<hr />
<form method="post" action="index.php?action=commenter">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet->getId() ?>" />
    <input type="submit" value="Commenter" />
</form>