<?php $this->titre = "Page d'administration'"; ?>


<header>
        <h1 >Page d'administration</h1>
</header>

<a class="btn" href="<?= "index.php?action=ajout" ?>">Ajouter un article</a>

<?php foreach ($billets as $billet): ?>
    <article>
        <header>
            <h1 class="titreBillet"><?= $billet->getTitre() ?></h1>
            <time><?= $billet->getDate() ?></time>
        </header>
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
