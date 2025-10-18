<?php
require_once(__DIR__ . "/../models/data/csvData.php");
require_once(__DIR__ . "/../models/dao/daofunctions/articleDAOFunc.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astronomy Articles</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="icon" type="image/x-icon" href="./assets/white_favicon.svg">
</head>
<body>
    <header>
        <h1><?= getCsvTitle(); ?></h1>
    </header>
    <main>
        <?php
            $connection = createConnection();
            $articleDAO = new ArticleDAOFunc($connection);
            $articles = $articleDAO->getAllArticles();
        ?>
        <?php foreach($articles as $article): ?>
            <section>
                <img src="<?= $article['img']; ?>" alt="Imagen de <?= $article['title']; ?>">
                <article>
                    <h2><?= $article['title']; ?></h2>
                    <p><?= $article['extract']; ?></p>
                </article>
            </section>
        <?php endforeach; ?>
    </main>
    <footer>
        <p class="footerText">
            Proyecto de 
            <strong>
                <a href="https://github.com/Eriquito00">Eriquito00</a>
            </strong>
            usando la API de Wikipedia.
            <br>
            Se aceptan pull requests en el repositorio del proyecto 
            <strong>
                <a href="https://github.com/Eriquito00/AstronomyArticlesPHP">AstronomyArticlesPHP</a>
            </strong>
            .
        </p>
    </footer>
</body>
</html>