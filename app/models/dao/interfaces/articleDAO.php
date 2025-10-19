<?php
interface articleDAO {
    public function existsArticleById($id);
    public function getAllArticles();
    public function createArticle($article);
}
?>