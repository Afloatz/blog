<?php $this->titre = "Page d'administration"; ?>



<h1 >Administration du blog</h1>

<table>
    <tr>
        <th>Auteur</th>
        <th>Date</th>
        <th>Contenu</th>  
    </tr>
<?php foreach ($comments as $comment): ?>
    <tr>
        <td><?= $comment->getAuteur() ?></td>
        <td><?= $comment->getDate() ?></td> 
        <td><?= htmlspecialchars_decode($comment->getContenu()) ?></td> 
        <td>
            <a class="btn" href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>">Supprimer</a>
            <a class="btn" href="<?= "index.php?action=editComment&id=" . $comment->getId() ?>">Modifier</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>



