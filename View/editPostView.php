<?php $this->titre = "Mon Blog - " . $post->getTitre(); ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>



<h3 id="titreReponses">Modifier le billet: <?= $post->getTitre() ?></h3>

<hr />
<form method="post" action="index.php?action=updatePost">
    <input id="title" name="title" type="text" value="<?= $post->getTitre() ?>" /><br />
    <textarea id="contect" name="content"><?= $post->getContenu() ?></textarea><br />
    <input type="hidden" name="id" value="<?= $post->getId() ?>" />
    <input type="submit" value="Sauvegarder" />
</form>