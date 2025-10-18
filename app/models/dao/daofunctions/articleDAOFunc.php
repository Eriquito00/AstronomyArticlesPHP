<?php
require_once (__DIR__ . "/../interfaces/articleDAO.php");

class ArticleDAOFunc implements articleDAO {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getAllArticles() {
        $stmt = $this->connection->prepare("SELECT * FROM articles;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createArticle($article) {
        $stmt = $this->connection->prepare("INSERT INTO articles (title, extract, img) VALUES (?, ?, ?);");
        $stmt->execute([
            $article->getTitle(),
            $article->getExtract(),
            $article->getImg()
        ]);
    }
}  
?>