<?php $this->titre = "Mon Blog - " . $billet['titre']; ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>


<header>
    <h1 id="titreReponses">Modifier le billet: <?= $billet['titre'] ?></h1>
</header>
<hr />
<form method="post" action="index.php?action=modifier">
    <input id="titleBillet" name="titleBillet" type="text" value="<?= $billet['titre'] ?>" /><br />
    <textarea id="txtBillet" name="contenu"><?= $billet['contenu'] ?></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Sauvegarder" />
</form>