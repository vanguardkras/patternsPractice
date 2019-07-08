<?php

interface DataProvider
{
    public function giveData(Check $checker): string;
}

class Book implements DataProvider
{
    public $pages;
    public $genre;
    public $weight;
    
    public function __construct($pages, $genre, $weight) 
    {
        $this->pages = $pages;
        $this->genre = $genre;
        $this->weight = $weight;
    }
    
    public function giveData(Check $checker): string
    {
        return $checker->checkBook($this);
    }
}

class Toy implements DataProvider
{
    public $age;
    public $material;
    public $weight;
    
    public function __construct($age, $material, $weight) 
    {
        $this->age = $age;
        $this->material = $material;
        $this->weight = $weight;
    }
    
    public function giveData(Check $checker): string
    {
        return $checker->checkToy($this);
    }
}

interface Check
{
    public function checkBook(Book $book): string;
    public function checkToy(Toy $toy): string;
}

class Get implements Check
{
    public function checkBook(Book $book): string
    {
        return 'Pages: ' . $book->pages . '<br>' .
                'Genre: ' . $book->genre . '<br>' .
                'Weight: ' . $book->weight . ' g<br>';
    }
    
    public function checkToy(Toy $toy): string
    {
        return 'Age: ' . $toy->age . '<br>' .
                'Material: ' . $toy->material . '<br>' .
                'Weight: ' . $toy->weight . ' kg<br>';
    }
}

$book = new Book(10, 'fantasy', 1200);
$toy = new Toy(12, 'wood', 2);

$check = new Get();

echo $book->giveData($check);
echo '<br>';
echo $toy->giveData($check);