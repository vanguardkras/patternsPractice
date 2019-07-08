<?php

class Changer
{
    private $wrapper;
    
    public function __construct(Wrapper $wrapper) 
    {
        $this->wrapper = $wrapper;
    }
    
    public function change(string $data): string
    {
        return $this->wrapper->wrap($data);
    }
    
    public function setWrapper(Wrapper $wrapper)
    {
        $this->wrapper = $wrapper;
    }
}

interface Wrapper
{
    public function wrap(string $data): string;
}

class Diver implements Wrapper
{
    public function wrap(string $data): string
    {
        return '<div>' . $data . '</div>';
    }
}

class Per implements Wrapper
{
    public function wrap(string $data): string
    {
        return '<p>' . $data . '</p>';
    }
}

$data = 'some data';
$a = new Changer(new Diver);
$div_data = $a->change($data);
$a->setWrapper(new Per);
$p_data = $a->change($data);
echo htmlspecialchars($div_data);
echo '<br>';
echo htmlspecialchars($p_data);