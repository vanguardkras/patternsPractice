<?php

class div
{
    private $color;
    private $width;
    private $height;
    public $div;
    
    private static function diviation(string $color, int $width, int $height): string
    {
        return '<div style="height:'.$height.'px; width:'.$width.'px; background:#'.$color.'"></div>';
    }
    
    public function __construct(string $color, int $width, int $height) 
    {
        $this->color = $color;
        $this->width = $width;
        $this->height = $height;
        $this->div = self::diviation($color, $width, $height);
        echo $this->div;
    }
    
    public function __clone() 
    {
        $color = hexdec($this->color) + 1118481;
        $color = dechex($color);
        $this->color = $color;
        $this->width = floor(0.9 * $this->width);
        $this->height = floor(0.9 * $this->height);
        $this->div = self::diviation($color, $this->width, $this->height);
        echo $this->div;
    }
}

$a = new div('AA0000', 200, 200);
$b = clone $a;
$c = clone $b;
$d = clone $c;
?>
