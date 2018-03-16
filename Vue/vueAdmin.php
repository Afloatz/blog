<?php $this->titre = "Page d'administration'"; ?>


<header>
        <h1 >Page d'administration</h1>
</header>

<!--Reprendre comme exemple la page d'accueil et permetre l'ajout de billets comme pour les commentaires-->

<?php foreach ($billets as $billet):
    ?>
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