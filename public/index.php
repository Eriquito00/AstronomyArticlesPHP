<?php
require_once(__DIR__ . "/../app/models/connection/connectionDB.php");

function loadCSVData(){
    require_once(__DIR__ . "/../app/models/data/csvData.php");
    require_once(__DIR__ . "/../app/services/wikipediaAPIClient.php");
    require_once(__DIR__ . "/../app/models/classes/article.php");
    require_once(__DIR__ . "/../app/models/dao/daofunctions/articleDAOFunc.php");

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

require_once(__DIR__ . "/../app/controllers/controller.php");
?>