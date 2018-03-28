<?php $this->titre = "Billet simple pour l'Alaska"; ?>

<h1>Billet simple pour l'Alaska</h1>

<?php foreach ($posts as $post): ?>
    
        <div>
            <a class="titreEpisode" href="<?= "index.php?action=post&id=" . $post->getId() ?>">
                <h3 class="titreBillet"><?= $post->getTitre() ?></h3>
            </a>
         
        </div>
  
    <hr />
<?php endforeach; ?>