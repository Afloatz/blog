<?php $this->titre = "Mon Blog - Ajout d'un billet" ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>



<h3 id="titreReponses">Ajouter un nouveau billet</h3>
<hr />
<form method="post" action="index.php?action=saveNewPost">
    <input id="title" name="title" type="text" placeholder="Titre du billet" /><br />
    <textarea id="content" name="content"></textarea><br />
    <input type="submit" value="Enregister" />
</form>