<?php $this->titre = "Page d'administration"; ?>



<h1 >Administration du blog</h1>

<!--Si des commentaires ont été signalé, on crée un tableau avec ces commentaires-->
<?php if($_SESSION['sum'] > 0): ?>
    <p>Commentaire à modérer:</p>
    <table>
        <tr>
            <th>Auteur</th>
            <th>Date</th>
            <th>Contenu</th>  
        </tr>
            <?php foreach ($comments as $comment): ?>
                <?php if($comment->getReport() != 0): ?>
                    <tr>
                        <td><?= $comment->getAuteur() ?></td>
                        <td><?= $comment->getDate() ?></td> 
                        <td><?= htmlspecialchars_decode($comment->getContenu()) ?></td> 
                        <td>
                            <a class="btn" href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>">Supprimer</a>
                            <a class="btn" href="<?= "index.php?action=editComment&id=" . $comment->getId() ?>">Modifier</a>
                        </td>
                    </tr>
                <?php endif; ?> 
            <?php endforeach; ?>         
    </table>
<?php endif; ?>  

<!-- On place les commentaires non signalé dans un autre tableau s'il y en a -->
<?php if($_SESSION['min'] == 0): ?>
    <p>Commentaire non signalé:</p>
    <table>
        <tr>
            <th>Auteur</th>
            <th>Date</th>
            <th>Contenu</th>  
        </tr>
            <?php foreach ($comments as $comment): ?>
                <?php if($comment->getReport() == 0): ?>
                    <tr>
                        <td><?= $comment->getAuteur() ?></td>
                        <td><?= $comment->getDate() ?></td> 
                        <td><?= htmlspecialchars_decode($comment->getContenu()) ?></td> 
                        <td>
                            <a class="btn" href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>">Supprimer</a>
                            <a class="btn" href="<?= "index.php?action=editComment&id=" . $comment->getId() ?>">Modifier</a>
                        </td>
                    </tr>
                <?php endif; ?> 
            <?php endforeach; ?>         
    </table>
<?php endif; ?> 






