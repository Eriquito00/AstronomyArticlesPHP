<?php
require_once (__DIR__ . "/../interfaces/articleDAO.php");

class ArticleDAOFunc implements articleDAO {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function existsArticleById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM articles WHERE article_id = ?;");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function getArticlesByPage($limit, $offset) {
        $stmt = $this->connection->prepare("SELECT * FROM articles ORDER BY article_id DESC LIMIT ? OFFSET ?;");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createArticle($article) {
        $stmt = $this->connection->prepare("INSERT INTO articles (article_id, title, extract, img) VALUES (?, ?, ?, ?);");
        $stmt->execute([
            $article->getId(),
            $article->getTitle(),
            $article->getExtract(),
            $article->getImg()
        ]);
    }

    public function getCountArticles(){
        $stmt = $this->connection->prepare("SELECT COUNT(*) as total FROM articles;");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }
}  
?>