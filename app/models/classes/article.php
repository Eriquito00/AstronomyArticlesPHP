<?php
class Article {
    private $id;
    private $title;
    private $extract;
    private $img = null;

    public function __construct($id = null, $title, $extract, $img){
        $this->id = $id;
        $this->title = $title;
        $this->extract = $extract;
        $this->img = $img;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getExtract(){
        return $this->extract;
    }

    public function getImg(){
        return $this->img;
    }
}
?>