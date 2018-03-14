<?php $this->titre = "Page d'administration'"; ?>


<header>
        <h1 >Page d'administration</h1>
</header>

<!--Reprendre comme exemple la page d'accueil et permetre l'ajout de billets comme pour les commentaires-->

<?php foreach ($billets as $billet):
    ?>
    <article>
        <header>
            <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
            <time><?= $billet['date'] ?></time>
        </header>
        <p><?= $billet['contenu'] ?></p>
        <a class="btn" href="<?= "index.php?action=suppression&id=" . $billet['id'] ?>">Supprimer</a>
        <a class="btn" href="<?= "index.php?action=modification&id=" . $billet['id'] ?>">Modifier</a>
    </article>
    <hr />
<?php endforeach; ?>