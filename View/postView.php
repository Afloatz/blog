<?php $this->titre = "Mon Blog - " . $billet->getTitre(); ?>

<article>
    <div>
        <h1 class="titreBillet"><?= $billet->getTitre() ?></h1>
        <time><?= $billet->getDate() ?></time>
    </div>
    <p><?= $billet->getContenu() ?></p>
</article>
<hr />

<h3 id="titreReponses">Laisser un commentaire:</h3>

<?php foreach ($commentaires as $commentaire): ?>
    <p><?= $commentaire->getAuteur() ?> dit :</p>
    <p><?= $commentaire->getContenu() ?></p>
    <a class="btn" href="<?= "index.php?action=signaler&idcomment=" . $commentaire->getId() . "&idbillet=" . $commentaire->getBilletId() ?>">Signaler</a>
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