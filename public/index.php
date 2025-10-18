<?php
require_once(__DIR__ . "/../app/models/connection/connectionDB.php");

if (!databaseExistsContent()){
    require_once(__DIR__ . "/../app/models/data/csvData.php");
    require_once(__DIR__ . "/../app/services/wikipediaAPIClient.php");
    require_once(__DIR__ . "/../app/models/classes/article.php");
    require_once(__DIR__ . "/../app/models/dao/daofunctions/articleDAOFunc.php");

    $connection = createConnection();

    $titles = getCsvData();

    foreach ($titles as $title){
        try {
            $apiInfo = getWikipediaArticle($title);
            $articleDAO = new ArticleDAOFunc($connection);
            $articleDAO->createArticle(new Article(
                "", 
                $apiInfo['title'],
                $apiInfo['extract'],
                $apiInfo['thumbnail']['source']
            ));
        } catch (Exception $e) {
            echo "Error getting article '$title': " . $e->getMessage() . "\n";
        }
    }

    $connection = null;
}

require_once(__DIR__ . "/../app/controllers/controller.php");
?>