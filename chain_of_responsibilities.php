<?php

interface Checker
{
    public function setNext(Checker $checker): Checker;
    public function check(string $text): ?string;
}

abstract class AbstractChecker implements Checker
{
    private $nextChecker;
    
    public function setNext(Checker $checker): Checker 
    {
        $this->nextChecker = $checker;
        return $checker;
    }
    
    public function check(string $text): ?string
    {
        if ($this->nextChecker) {
            return $this->nextChecker->check($text);
        }
        return null;
    }
}

class RussianChecker extends AbstractChecker
{
    private $letters = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж','з', 'и','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'];
    
    public function check(string $text): ?string 
    {
        foreach ($this->letters as $let) {
            if(stristr($text, $let)) {
                echo 'Russian<br>';
                return 'Russian';
            }
        }
        return parent::check($text);
    }
}

class EnglishChecker extends AbstractChecker
{
    private $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h','i', 'g','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    
    public function check(string $text): ?string 
    {
        foreach ($this->letters as $let) {
            if(stristr($text, $let)) {
                echo 'English<br>';
                return 'English';
            }
        }
        return parent::check($text);
    }
}

$text = 'тест';
$rus = new RussianChecker;
$eng = new EnglishChecker;
$rus->setNext($eng);

$rus->check($text);