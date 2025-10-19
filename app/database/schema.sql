CREATE DATABASE IF NOT EXISTS articles_db;
USE articles_db;

CREATE TABLE IF NOT EXISTS articles (
    article_id      VARCHAR(50) NOT NULL PRIMARY KEY,
    title           VARCHAR(50) NOT NULL,
    extract         TEXT NOT NULL,
    img             VARCHAR(255)
);