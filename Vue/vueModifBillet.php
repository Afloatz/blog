<?php $this->titre = "Mon Blog - " . $billet->getTitre(); ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>



<h3 id="titreReponses">Modifier le billet: <?= $billet->getTitre() ?></h3>

<hr />
<form method="post" action="index.php?action=modifier">
    <input id="titleBillet" name="titleBillet" type="text" value="<?= $billet->getTitre() ?>" /><br />
    <textarea id="txtBillet" name="contenu"><?= $billet->getContenu() ?></textarea><br />
    <input type="hidden" name="id" value="<?= $billet->getId() ?>" />
    <input type="submit" value="Sauvegarder" />
</form>