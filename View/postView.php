<?php $this->titre = "Mon Blog - " . $post->getTitre(); ?>

<article>
    <div>
        <h1 class="titreBillet"><?= $post->getTitre() ?></h1>
        <time><?= $post->getDate() ?></time>
    </div>
    <p><?= htmlspecialchars_decode($post->getContenu()) ?></p>
</article>
<hr />

<h3 id="titreReponses">Commentaires:</h3>

<?php foreach ($comments as $comment): ?>
    <p><?= $comment->getAuteur() ?> dit :</p>
    <p><?= $comment->getContenu() ?></p>
    <a class="btn" href="<?= "index.php?action=reportComment&commentId=" . $comment->getId() . "&postId=" . $comment->getBilletId() ?>">Signaler</a>
<?php endforeach; ?>
<hr />

<h3>Laisser un commentaire:</h3>

<form method="post" action="index.php?action=addComment">
    <input id="author" name="author" type="text" placeholder="Votre pseudo" required /><br />
    <textarea id="content" name="content" rows="4" placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $post->getId() ?>" />
    <input type="submit" value="Commenter" />
</form>