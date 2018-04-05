<?php $this->titre = "Billet simple pour l'Alaska"; ?>

<div class="row">
  <section>
    <img src="Public/images/aurora.jpg" alt="Alaska">
  </section>
</div>

<div class="row">
    <article class="col-md-7">
        <blockquote>
         Nam nisi urna, accumsan sollicitudin tempor eget, consectetur eu augue.
         Fusce sodales porta elit eu dictum. Ut sit amet malesuada quam. Mauris tristique 
         tristique erat eget ornare. Nullam nulla ante, consectetur eu sagittis quis, ullamcorper 
         convallis turpis. Mauris facilisis bibendum libero, nec rutrum arcu imperdiet et. Nullam suscipit, elit vitae pellentesque accumsan, felis velit mattis lectus, efficitur maximus elit nibh at dolor. In faucibus est ultrices sapien fringilla tincidunt. Phasellus eleifend porta purus sit amet venenatis. Maecenas convallis sed massa et feugiat. Donec vitae sem hendrerit, convallis nunc vel, fringilla ante. Maecenas mollis est vitae lectus ornare, at pretium eros imperdiet. Aliquam in elit a metus viverra convallis ut eget lacus. Vivamus nec ex sit amet odio tristique tincidunt sed in enim. Phasellus lorem libero, rhoncus et velit non, dictum semper ipsum.<br>
         <small class="pull-right">Jean Forteroche</small><br>
       </blockquote>
    </article>
    <aside class="col-md-5">
      <?php foreach ($posts as $post): ?>
    
        <div>
            <a class="titreEpisode" href="<?= "index.php?action=post&id=" . $post->getId() ?>">
                <h5 class="titreBillet"><?= $post->getTitre() ?></h5>
            </a>
         
        </div>
  
    <hr />
    <?php endforeach; ?>
    </aside>
</div>


