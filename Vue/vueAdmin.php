<?php $this->titre = "Page d'administration"; ?>



<h1 >Administration du blog</h1>


<a class="btn" href="<?= "index.php?action=ajout" ?>">Ajouter un billet</a>

<?php foreach ($billets as $billet): ?>
    <article>
        <div>
            <h3 class="titreBillet"><?= $billet->getTitre() ?></h3>
            <time><?= $billet->getDate() ?></time>
        </div>
        <p><?= $billet->getContenu() ?></p>
        <a class="btn" href="<?= "index.php?action=suppression&id=" . $billet->getId() ?>">Supprimer</a>
        <a class="btn" href="<?= "index.php?action=modification&id=" . $billet->getId() ?>">Modifier</a>
    </article>
    <hr />
<?php endforeach; ?>

<h2>Modération des commentaires</h2>

<?php foreach ($commentaires as $commentaire): ?>
    <article>
        <p><?= $commentaire->getAuteur() ?> dit :</p>
        <p><?= $commentaire->getContenu() ?></p>
        <a class="btn" href="<?= "index.php?action=suppressionCom&id=" . $commentaire->getId() ?>">Supprimer</a>
        <a class="btn" href="<?= "index.php?action=modificationCom&id=" . $commentaire->getId() ?>">Modifier</a>
    </article>
    <hr />
<?php endforeach; ?>
