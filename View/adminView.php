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
                <button class="btn btn-warning" data-href="<?= "index.php?action=deletePost&id=" . $post->getId() ?>" data-toggle="modal" data-target="#confirm">
                    supprimer
                </button>
                <!--Ouvre une fenêtre pour confirmer la suppression-->
                <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">x</button>
                                <h4 class="modal-title">Merci de confirmer</h4>               
                            </div>
                            <div class="modal-body">
                                Etes-vous certain de vouloir supprimer?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                                <a class="btn btn-danger btn-ok">Oui</a>
                            </div>
                        </div>
                    </div>
                </div>                                           
                <a class="btn btn-success" href="<?= "index.php?action=editPost&id=" . $post->getId() ?>">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</section>
