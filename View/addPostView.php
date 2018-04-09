<?php $this->titre = "Mon Blog - Ajout d'un billet" ?>

<head>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>

<section class="col-md-11">

    <h3 id="titreReponses">Ajouter un nouveau billet</h3>
    <hr />
    
    <form class="col-md-10" method="post" action="index.php?action=saveNewPost">
        <input id="title" class="form-control" name="title" type="text" placeholder="Titre du billet" /><br />
        <textarea id="content" name="content"></textarea><br />
        <input class="btn btn-primary" type="submit" value="Enregister" />
    </form>

</section>