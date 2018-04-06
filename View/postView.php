<?php $this->titre = "Mon Blog - " . $post->getTitre(); ?>


<article class="col-md-11">
    <div>
        <h1><?= $post->getTitre() ?></h1>
        <time><?= $post->getDate() ?></time>
    </div>
    <p><?= $post->getContenu() ?></p>
</article>
<hr />
   

<section class="col-md-11">
    <h3>Commentaires:</h3>
    <?php foreach ($comments as $comment): ?>
        <p><?= $comment->getAuteur() ?> dit :</p>
        <p><?= $comment->getContenu() ?></p>
        
        <button class="btn btn-warning" data-href="<?= "index.php?action=reportComment&commentId=" . $comment->getId() . "&postId=" . $post->getId()  ?>" data-toggle="modal" data-target="#confirm">
            signaler
        </button>
        <!--Ouvre une fenêtre pour confirmer le signalement-->
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Merci de confirmer</h4>               
                    </div>
                    <div class="modal-body">
                        Etes-vous certain de vouloir signaler ce commentaire?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                        <a class="btn btn-danger btn-ok">Oui</a>
                    </div>
                </div>
            </div>
        </div>           
        <br><br>
    <?php endforeach; ?>
</section>
<hr />


<form class="col-lg-6" method="post" action="index.php?action=addComment">
    <legend>Laisser un commentaire:</legend>
    <input id="author" class="form-control" name="author" type="text" placeholder="Votre pseudo" required /><br />
    <textarea id="content" class="form-control" name="content" rows="4" placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $post->getId() ?>" />
    <button class="btn btn-primary" type="submit">Envoyer</button>
</form>