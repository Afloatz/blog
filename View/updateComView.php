<?php $this->titre = "Mon Blog - " . $commentaire->getAuteur(); ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>


<h3 id="titreReponses">Modifier le commentaire de: <?= $commentaire->getAuteur() ?></h3>

<hr />
<form method="post" action="index.php?action=modifierCom">
    <input id="author" name="author" type="text" value="<?= $commentaire->getAuteur() ?>" /><br />
    <textarea id="contenu" name="contenu"><?= $commentaire->getContenu() ?></textarea><br />
    <input type="hidden" name="id" value="<?= $commentaire->getId() ?>" />
    <input type="submit" value="Sauvegarder" />
</form>