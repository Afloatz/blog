<?php $this->titre = "Mon Blog - " . $post->getTitre(); ?>


<article class="col-md-11">
    <div>
        <h1><?= $post->getTitre() ?></h1>
        <time><?= $post->getDate() ?></time>
    </div>
    <p><?= $post->getContenu() ?></p>
</article>
<hr />
   

<section class="col-md-11">
    <h3>Commentaires:</h3>
    <?php foreach ($comments as $comment): ?>
        <p><?= $comment->getAuteur() ?> dit :</p>
        <p><?= $comment->getContenu() ?></p>
        <a class="btn btn-danger" href="<?= "index.php?action=reportComment&commentId=" . $comment->getId() . "&postId=" . $post->getId()  ?>">Signaler</a>
        <br><br>
    <?php endforeach; ?>
</section>
<hr />


<form class="col-lg-6" method="post" action="index.php?action=addComment">
    <legend>Laisser un commentaire:</legend>
    <input id="author" class="form-control" name="author" type="text" placeholder="Votre pseudo" required /><br />
    <textarea id="content" class="form-control" name="content" rows="4" placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $post->getId() ?>" />
    <button class="btn btn-primary" type="submit">Envoyer</button>
</form>