<?php $this->titre = "Page d'administration"; ?>



<h1 >Administration du blog</h1>

<p>
    <a class="btn" href="<?= "index.php?action=addPost" ?>">Ajouter un billet</a>
    
    <!--Afficher bouton en rouge si des commenttaires ont été signalé-->
    <?php if($_SESSION['sum'] > 0): ?>
        <a class="btn-moderate" href="<?= "index.php?action=adminComments" ?>">Gérer les commentaires!</a>
    <?php else: ?>
        <a class="btn" href="<?= "index.php?action=adminComments" ?>">Gérer les commentaires</a>
    <?php endif; ?>    
</p>



<table>
    <tr>
        <th>Titre</th>
        <th>Date</th>
    </tr>
<?php foreach ($posts as $post): ?>
    <tr>
        <td><?= $post->getTitre() ?></td>
        <td><?= $post->getDate() ?></td> 
        <td>
            <a class="btn" href="<?= "index.php?action=deletePost&id=" . $post->getId() ?>">Supprimer</a>
            <a class="btn" href="<?= "index.php?action=editPost&id=" . $post->getId() ?>">Modifier</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>

