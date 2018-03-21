<?php $this->titre = "Billet simple pour l'Alaska"; ?>

<h1>Billet simple pour l'Alaska</h1>

<?php foreach ($billets as $billet): ?>
    
        <div>
            <a class="titreEpisode" href="<?= "index.php?action=billet&id=" . $billet->getId() ?>">
                <h3 class="titreBillet"><?= $billet->getTitre() ?></h3>
            </a>
         
        </div>
  
    <hr />
<?php endforeach; ?>