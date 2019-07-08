<?php

//Itearates an array elements in order: first, last, second, before last.
class EachElement implements \Iterator
{
    private $list;
    private $position;
    private $end = false;
    private $size;
    private $valid = true;
    
    public function __construct($list)
    {
        $this->list = $list;
        $this->position = 0;
        $this->size = count($list);
    }
    
    public function key()
    {
        return $this->position;
    }
    
    public function rewind()
    {
        $this->position;
    }
    
    public function current()
    {
        return $this->list[$this->position];
    }
    
    public function valid(): bool
    {
        return $this->valid;
    }
    
    public function next()
    {
        if($this->end) {
            $next = $this->size - $this->position;
            $this->end = false;
        } else {
            $next = $this->size - $this->position - 1;
            $this->end = true;
        }
        $this->valid = $next === $this->position ? false : true;
        $this->position = $next;
    }
}

$list = [1,2,3,4,5,6,7,8,9,10];
$a = new EachElement($list);

foreach ($a as $b) {
    echo $b;
    echo '<br>';
}