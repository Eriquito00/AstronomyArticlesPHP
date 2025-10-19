<?php
interface articleDAO {
    public function existsArticleById($id);
    public function getArticlesByPage($limit, $offset);
    public function createArticle($article);
    public function getCountArticles();
}
?>