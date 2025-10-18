CREATE DATABASE IF NOT EXISTS astronomy_articles_db;
USE astronomy_articles_db;

CREATE TABLE IF NOT EXISTS articles (
    article_id      INT AUTO_INCREMENT PRIMARY KEY,
    title           VARCHAR(50) NOT NULL,
    extract         TEXT NOT NULL,
    img             VARCHAR(255) NOT NULL
);