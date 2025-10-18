<?php
function createConnection(){
    $tempCon = new PDO("mysql:host=localhost;charset=utf8", "root", "");
    $tempCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tempCon->exec(file_get_contents(__DIR__ . '/../../database/schema.sql'));

    $con = new PDO("mysql:host=localhost;dbname=astronomy_articles_db;charset=utf8", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
}

function databaseExistsContent() {
    try {
        $con = new PDO("mysql:host=localhost;dbname=astronomy_articles_db;charset=utf8", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->prepare("SELECT * FROM articles LIMIT 20");
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}
?>