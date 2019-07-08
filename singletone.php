<?php

class Singleton
{
    public static $instances = [];
    
    protected function __construct() { }
    
    public function __wakeup() 
    {
        throw new Exception('singletone cannot be serialized');
    }
    
    protected function __clone() { }
    
    public static function getInstance(): Singleton
    {
        $class = static::class;
        if (empty(self::$instances[$class])) {
            self::$instances[$class] = new static;
        }
        return self::$instances[$class];
    }
}

class Square extends Singleton
{
    private $side = 20;
    
    public function setSide($side)
    {
        $this->side = $side;
    }
    
    public function getSide()
    {
        return $this->side;
    }
}

$a = Square::getInstance();
$a->setSide(40);
$b = Square::getInstance();
echo $b->getSide();