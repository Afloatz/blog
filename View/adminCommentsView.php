<?php $this->titre = "Page d'administration"; ?>



<h1 >Administration du blog</h1>

<section class="col-sm-8 table-responsive">
    <!--Si des commentaires ont été signalé, on crée un tableau avec ces commentaires-->
    <?php if($_SESSION['sum'] > 0): ?>
        <h4>Commentaire à modérer:</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Contenu</th>  
                </tr>
            </thead>
                <?php foreach ($comments as $comment): ?>
                    <?php if($comment->getReport() != 0): ?>
                        <tr>
                            <td><?= $comment->getAuteur() ?></td>
                            <td><?= $comment->getDate() ?></td> 
                            <td><?= htmlspecialchars_decode($comment->getContenu()) ?></td> 
                            <td>
                                <a class="btn btn-warning" href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>">Supprimer</a>
                                <a class="btn btn-success" href="<?= "index.php?action=editComment&id=" . $comment->getId() ?>">Modifier</a>
                            </td>
                        </tr>
                    <?php endif; ?> 
                <?php endforeach; ?>         
        </table>
    <?php endif; ?>  
</section>

<section class="col-sm-8 table-responsive">
    <!-- On place les commentaires non signalé dans un autre tableau s'il y en a -->
    <?php if($_SESSION['min'] == 0): ?>
        <h4>Commentaire non signalé:</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Contenu</th>  
                </tr>
            </thead>
                <?php foreach ($comments as $comment): ?>
                    <?php if($comment->getReport() == 0): ?>
                        <tr>
                            <td><?= $comment->getAuteur() ?></td>
                            <td><?= $comment->getDate() ?></td> 
                            <td><?= htmlspecialchars_decode($comment->getContenu()) ?></td> 
                            <td>
                                <a class="btn btn-warning" href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>">Supprimer</a>
                                <a class="btn btn-success" href="<?= "index.php?action=editComment&id=" . $comment->getId() ?>">Modifier</a>
                            </td>
                        </tr>
                    <?php endif; ?> 
                <?php endforeach; ?>         
        </table>
    <?php endif; ?>
</section>







