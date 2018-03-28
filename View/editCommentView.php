<?php $this->titre = "Mon Blog - " . $comment->getAuteur(); ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>


<h3 id="titreReponses">Modifier le commentaire de: <?= $comment->getAuteur() ?></h3>

<hr />
<form method="post" action="index.php?action=updateComment">
    <input id="author" name="author" type="text" value="<?= $comment->getAuteur() ?>" /><br />
    <textarea id="content" name="content"><?= $comment->getContenu() ?></textarea><br />
    <input type="hidden" name="id" value="<?= $comment->getId() ?>" />
    <input type="submit" value="Sauvegarder" />
</form>