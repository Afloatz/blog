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
                                
                                <button class="btn btn-warning" data-href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>" data-toggle="modal" data-target="#confirm">
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

                                <button class="btn btn-warning" data-href="<?= "index.php?action=deleteComment&id=" . $comment->getId() ?>" data-toggle="modal" data-target="#confirm">
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
                               
                                <a class="btn btn-success" href="<?= "index.php?action=editComment&id=" . $comment->getId() ?>">Modifier</a>
                            </td>
                        </tr>
                    <?php endif; ?> 
                <?php endforeach; ?>         
        </table>
    <?php endif; ?>
</section>







