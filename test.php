<?php

class Book {

}


$book = new Book();

$book->id = 101;

$book->label = "Lorem ipsum";


$jsonData = json_encode($book);

var_dump($jsonData);