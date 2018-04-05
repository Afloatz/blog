<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Public/css/bootstrap.css" />
        <link rel="stylesheet" href="Public/css/style.css" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div class="container-fluid">
            
            <header class="row"> <!-- En tête de la page-->
                <nav class="navbar navbar-inverse"> <!--Menu de navigation-->
                  <div class="container-fluid">
                     <div class="navbar-header">
                      <a class="navbar-brand">Jean Forteroche</a>
                    </div>
                    <ul class="nav navbar-nav">
                      <li> <a href="index.php">Accueil</a> </li>
                      <?php if(isset($_SESSION['auth'])): ?>
                        <li> <a href="<?= "index.php?action=admin" ?>">Administration</a> </li>
                        <li> <a href="<?= "index.php?action=logout" ?>">Se déconnecter</a> </li>
                      <?php else: ?>
                        <li> <a href="<?= "index.php?action=login" ?>">S'identifier</a> </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                </nav>
            </header>
            
            <div class="row">
                <?= $contenu ?>
            </div>
            
            
            <footer class="row">
                Blog réalisé dans le cadre d'un projet école avec PHP, HTML5 et CSS.
            </footer>
            
        </div> 
    </body>
</html>