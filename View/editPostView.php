<?php $this->titre = "Mon Blog - " . $post->getTitre(); ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>

<section class="col-md-11">

    <h3 id="titreReponses">Modifier le billet: <?= $post->getTitre() ?></h3>

    <hr />
    <form class="col-md-10" method="post" action="index.php?action=updatePost">
        <input id="title" class="form-control" name="title" type="text" value="<?= $post->getTitre() ?>" /><br />
        <textarea id="content" name="content"><?= $post->getContenu() ?></textarea><br />
        <input type="hidden" name="id" value="<?= $post->getId() ?>" />
        <input class="btn btn-primary" type="submit" value="Sauvegarder" />
    </form>

</section>