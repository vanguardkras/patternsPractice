<?php

class Wrapper
{
    private $result;
    
    public function __construct($data)
    {
        $this->result = $data;
    }
    
    public function wrap(string $block, string $class = ''): void
    {
        
        try {
            if (!self::checkBlocks($block)) {
                throw new Exception('This block does not exist');
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $result = '<'.$block.' class="'.$class.'">';
        $result .= $this->result;
        $result .= '</'.$block.'>';
        $this->result = $result;
    }
    
    private static function checkBlocks(string $block): bool
    {
        $block_list = [
            'div',
            'span',
            'p',
            'b',
        ];
        return in_array($block, $block_list) ? true : false;
    }
    
    public function getResult()
    {
        return $this->result;
    }
}

class Article
{
    public $data;
    public $match;
    
    public function __construct(string $data) 
    {
        $this->data = $data;
    }
    
    public function match($data)
    {
        preg_match('/'.$data.'/i', $this->data, $matches);
        $this->match = $matches[0];
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function mamabolder($replace)
    {
        $this->data = preg_replace('/mama/i', $replace, $this->data);
    }
}

interface Helper
{   
    public function __construct(Wrapper $wrapper, Article $article);
}

class Merger
{
    public $article;
    
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    
    public function mamabolder()
    {
        $this->article->match('mama');
        $wrapper = new Wrapper($this->article->match);
        $wrapper->wrap('b', 'mama');
        $temp = $wrapper->getResult();
        $this->article->mamabolder($temp);
        return $this->article->data;
    }
}

$data = 'Mama washed a frame';
$b = new Article($data);
$c = new Merger($b);
echo $c->mamabolder();