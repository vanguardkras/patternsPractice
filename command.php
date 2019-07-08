<?php

interface Command
{
    public function execute(string $string);
}

class Diver implements Command
{
    private $changer;
    
    public function __construct(Changer $changer)
    {
        $this->changer = $changer;
    }
    
    public function execute(string $string)
    {
        $string = $this->changer->change($string);
        return '<div>'.$string.'</div>';
    }        
}


class Spaner implements Command
{
    private $changer;
    
    public function __construct(Changer $changer)
    {
        $this->changer = $changer;
    }
    
    public function execute(string $string)
    {
        $string = $this->changer->change($string);
        return '<span>'.$string.'</span>';
    }
}

class Changer
{
    public function change(string $string): string
    {
        
        $string = strtoupper($string);
        $string = str_split($string);
        $string = implode('.', $string);
        return $string;
        
    }
}

class Invoker
{
    private $string;
    
    public function __construct(string $string)
    {
        $this->string = $string;
    }
    
    public function superChange(Command $command)
    {
        $this->string = $command->execute($this->string);
        return $this;
    }
    
    public function getResult()
    {
        return $this->string;
    }
}

$string = 'Beleberda';
$a = new Invoker($string);
$a->superChange(new Diver(new Changer))->superChange(new Spaner(new Changer));
echo $a->getResult();