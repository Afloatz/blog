<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/style.css" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="block_page">
            <header>
                <a href="index.php"><h1 id="titreBlog">Mon Blog</h1></a>
                <a class="btn" href="<?= "index.php?action=connexion" ?>">S'identifier</a>
                <p>Je vous souhaite la bienvenue sur ce blog.</p>
            </header>
            <div id="contenu">
                <?= $contenu ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>