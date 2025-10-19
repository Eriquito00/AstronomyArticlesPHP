<?php
$connection = createConnection();
$articleDAO = new ArticleDAOFunc($connection);

$articlesPage = isset($_GET['articlesPerPage']) ? (int)$_GET['articlesPerPage'] : 5;
$actualPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($articlesPage <= 2) $articlesPage = 2;
else if ($articlesPage >= 10) $articlesPage = 10;
else $articlesPage = 5;

$totalPages = ceil($articleDAO->getCountArticles() / $articlesPage);

if ($actualPage < 1) $actualPage = 1;
else if ($actualPage > $totalPages) $actualPage = $totalPages;

$offset = ($actualPage - 1) * $articlesPage;
$articles = $articleDAO->getArticlesByPage($articlesPage, $offset);

foreach($articles as $article): ?>
    <section>
    <?php if ($article["img"]):?>
        <img src="<?= $article['img']; ?>" alt="Imagen de <?= $article['title']; ?>">
    <?php endif; ?>
        <article>
            <h2><?= $article['title']; ?></h2>
            <p><?= $article['extract']; ?></p>
        </article>
    </section>
<?php endforeach; 

// Parámetro para mantener articlesPerPage en paginación
$articlesParam = isset($_GET['articlesPerPage']) ? "&articlesPerPage=" . (int)$_GET['articlesPerPage'] : "";
?>

<nav class="pagination">
    <?php if ($actualPage > 2): ?>
        <a class="simbols" href="?page=<?= $actualPage - 2 ?><?= $articlesParam ?>"><<</a>
    <?php endif; ?>

    <?php if ($actualPage > 1): ?>
        <a class="simbols" href="?page=<?= $actualPage - 1 ?><?= $articlesParam ?>"><</a>
    <?php endif; ?>

    <?php
        $startPage = $actualPage > 3 ? $actualPage - 1 : 2;
        $endPage = $actualPage < $totalPages - 3 ? $actualPage + 1 : $totalPages - 1;
    ?>

    <a href="?page=1<?= $articlesParam ?>" class="numbers<?= (1 === $actualPage) ? 'active' : '' ?>">1</a>

    <?php if ($startPage > 2) :?>
        <a class="points">···</a>
    <?php endif;

    for ($i = $startPage; $i <= $endPage; $i++): ?>
        <a href="?page=<?= $i ?><?= $articlesParam ?>" class="numbers<?= ($i === $actualPage) ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
    
    <?php if ($endPage < $totalPages - 1) :?>
        <a class="points">···</a>
    <?php endif; ?>

    <a href="?page=<?= $totalPages ?><?= $articlesParam ?>" class="numbers<?= ($totalPages === $actualPage) ? 'active' : '' ?>"><?= $totalPages ?></a>

    <?php if ($actualPage < $totalPages): ?>
        <a class="simbols" href="?page=<?= $actualPage + 1 ?><?= $articlesParam ?>">></a>
    <?php endif; ?>

    <?php if ($actualPage < $totalPages - 1): ?>
        <a class="simbols" href="?page=<?= $actualPage + 2 ?><?= $articlesParam ?>">>></a>
    <?php endif; ?>
</nav>

<?php
$connection = null;
?>