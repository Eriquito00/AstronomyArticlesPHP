<?php
function getCsvTitle(){
    $file = __DIR__ . "/../../resources/titleArticles.csv";
    $data = fopen($file, "r");
    $firstLine = fgets($data);
    fclose($data);
    return trim($firstLine);
}

function getCsvData(){
    $file = __DIR__ . "/../../resources/titleArticles.csv";
    $data = fopen($file, "r");
    $titles = [];
    fgets($data); //skip el titulo
    while (($line = fgets($data)) !== false) {
        $titles[] = trim($line);
    }
    fclose($data);
    return $titles;
}
?>