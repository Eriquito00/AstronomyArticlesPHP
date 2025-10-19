<?php
require_once(__DIR__ . "/../models/connection/connectionDB.php");
require_once(__DIR__ . "/../models/data/csvData.php");
require_once(__DIR__ . "/../services/wikipediaAPIClient.php");
require_once(__DIR__ . "/../models/classes/article.php");
require_once(__DIR__ . "/../models/dao/daofunctions/articleDAOFunc.php");

function loadCSVData(){
    $connection = createConnection();
    $titles = getCsvData();
    $errors = [];

    foreach ($titles as $title){
        try {
            $apiInfo = getWikipediaArticle($title);
            $articleDAO = new ArticleDAOFunc($connection);
            $id = $apiInfo['wikibase_item'];
            
            if (!$articleDAO->existsArticleById($id)) {
                $articleDAO->createArticle(new Article(
                    $id, 
                    $apiInfo['title'],
                    $apiInfo['extract'],
                    $apiInfo['thumbnail']['source'] ?? null
                ));
            }
        } catch (Exception $e) {
            if (strpos($e->getMessage(), "disambiguation") !== false) {
                $errors[] = "La búsqueda de '$title' encaja con varios artículos diferentes.";
            } else {
                $errors[] = "Error al obtener artículo '$title': " . $e->getMessage();
            }
        }
    }

    $connection = null;
    return $errors;
}

$errors = [];

if (!databaseExistsContent()){
    $errors = loadCSVData();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reload'])){
    $errors = loadCSVData();
}

require_once(__DIR__ . "/../views/page.php");
?>