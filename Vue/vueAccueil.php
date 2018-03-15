<?php $this->titre = "Mon Blog"; ?>

<?php foreach ($billets as $billet):
    ?>
    <article>
        <header>
            <a href="<?= "index.php?action=billet&id=" . $billet->getId() ?>">
                <h1 class="titreBillet"><?= $billet->getTitre() ?></h1>
            </a>
            <time><?= $billet->getDate() ?></time>
        </header>
        <p><?= $billet->getContenu() ?></p>
    </article>
    <hr />
<?php endforeach; ?>