<?php

interface Element
{
    public function display(string $text): string;
}

class BuildElement implements Element
{
    public function display(string $text): string
    {
        return '<p>'.$text.'</p>';
    }
}

class Wrapper implements Element
{
    protected $elem;
    
    public function __construct(Element $elem)
    {
        $this->elem = $elem;
    }
    
    public function display(string $string): string
    {
        return $this->elem->display($string);
    }
}

class Diver extends Wrapper
{
    public function display(string $string): string 
    {
        return '<div>'.parent::display($string).'</div>';
    }
}

class Spaner extends Wrapper
{
    public function display(string $string): string 
    {
        return '<span>'.parent::display($string).'</span>';
    }
}

$a = new BuildElement();
$b = new Spaner($a);
$c = new Diver($b);
echo $c->display('test');