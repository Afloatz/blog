<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Public/style.css" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="block_page">
            
            <header> <!-- En tête de la page-->
                <h1>Jean Forteroche</h1>

                
                <nav class="menu"> <!--Menu de navigation-->
                	<ul>
                   	    <li><a href="index.php">Accueil</a></li> 
                        <?php if(isset($_SESSION['auth']) AND $_SESSION['auth']): ?>
                            <li><a href="<?= "index.php?action=admin" ?>">Administration</a></li>
                            <li><a href="<?= "index.php?action=logout" ?>">Se déconnecter</a></li>
                        <?php else: ?>
                    	   <li><a href="<?= "index.php?action=login" ?>">S'identifier</a></li>
                    	<?php endif; ?>
               		</ul>
                </nav>
                
                

            </header>
            
            <div id="contenu">
                <?= $contenu ?>
            </div> 
            
            <footer id="piedBlog">
                Blog réalisé dans le cadre d'un projet école avec PHP, HTML5 et CSS.
            </footer>
            
        </div> 
    </body>
</html>