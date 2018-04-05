<?php $this->titre = "Page d'administration"; ?>



<h1 >Administration du blog</h1>




<section class="col-sm-8 table-responsive">
        <p>
            <a class="btn btn-primary" href="<?= "index.php?action=addPost" ?>">Ajouter un billet</a>

            <!--Afficher bouton en rouge si des commenttaires ont été signalé-->
            <?php if($_SESSION['sum'] > 0): ?>
                <a class="btn btn-danger" href="<?= "index.php?action=adminComments" ?>">Gérer les commentaires!</a>
            <?php else: ?>
                <a class="btn btn-primary" href="<?= "index.php?action=adminComments" ?>">Gérer les commentaires</a>
            <?php endif; ?>    
        </p>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
            </tr>
        </thead>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post->getTitre() ?></td>
            <td><?= $post->getDate() ?></td> 
            <td>
                <a class="btn btn-warning" href="<?= "index.php?action=deletePost&id=" . $post->getId() ?>">Supprimer</a>
                <a class="btn btn-success" href="<?= "index.php?action=editPost&id=" . $post->getId() ?>">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</section>
