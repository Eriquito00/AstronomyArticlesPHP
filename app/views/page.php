<?php
require_once(__DIR__ . "/../models/data/csvData.php");
require_once(__DIR__ . "/../models/dao/daofunctions/articleDAOFunc.php");
require_once(__DIR__ . "/../models/connection/connectionDB.php");
$pageName = getCsvTitle();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageName; ?></title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>
<body>
    <header>
        <h1><?= $pageName; ?></h1>
    </header>
    <main>
        <?php
            $connection = createConnection();
            $articleDAO = new ArticleDAOFunc($connection);
            $articles = $articleDAO->getAllArticles();
            foreach($articles as $article): 
                if ($article["img"] !== null):?>
                <section>
                    <img src="<?= $article['img']; ?>" alt="Imagen de <?= $article['title']; ?>">
                    <article>
                        <h2><?= $article['title']; ?></h2>
                        <p><?= $article['extract']; ?></p>
                    </article>
                </section>
                <?php else: ?>
                <section>
                    <article>
                        <h2><?= $article['title']; ?></h2>
                        <p><?= $article['extract']; ?></p>
                    </article>
                </section>
                <?php endif ?>
            <?php endforeach;
            $connection = null;
        ?>
        <form method="POST" action="">
            <button type="submit" name="reload">Recargar artículos</button>
        </form>
        <?php if (!empty($errors)): 
            foreach ($errors as $error): ?>
                <p class="error"><?= htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
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