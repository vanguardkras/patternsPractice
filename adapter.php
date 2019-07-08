<?php

interface Time
{
    public function getDate($time): string;
}

class UnixTime implements Time
{
    public function getDate($timespan): string 
    {
        $a = new DateTime;
        $a->setTimestamp($timespan);
        return $a->format('d-m-Y');
    }
}

class StringTime
{
    public function getTime($time)
    {
        return date('Y/M/d', $time);
    }
}

class Adapter implements Time
{
    private $str;
    
    public function __construct(StringTime $class) 
    {
        $this->str = $class;
    }
    
    public function getDate($time): string 
    {
        $temp = strtotime($this->str->getTime($time));
        return date('d-m-Y', $time);
    }
}


$a = new UnixTime;
echo $a->getDate(1231231231);

echo '<br>';
$b = new StringTime;
echo $b->getTime(1231231231);
echo '<br>';
$c = new Adapter($b);
echo $c->getDate(1231231231);