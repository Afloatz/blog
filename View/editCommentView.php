<?php $this->titre = "Mon Blog - " . $comment->getAuteur(); ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>

<section class="col-md-11">

    <h3 id="titreReponses">Modifier le commentaire de: <?= $comment->getAuteur() ?></h3>

    <hr />
    <form class="col-md-10" method="post" action="index.php?action=updateComment">
        <input id="author" class="form-control" name="author" type="text" value="<?= $comment->getAuteur() ?>" /><br />
        <textarea id="content" name="content"><?= $comment->getContenu() ?></textarea><br />
        <input type="hidden" name="id" value="<?= $comment->getId() ?>" />
        <input class="btn btn-primary" type="submit" value="Sauvegarder" />
    </form>

</section>