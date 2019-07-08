<?php

interface Creator 
{

    public function authForm(): Creator;

    public function header(string $logo): Creator;

    public function footer(string $phone): Creator;
    
    public function wrapPage(): Creator;
    
    public function get(): string;
}

class StandardCreator implements Creator {

    private $page;

    public function __construct() 
    {
        $this->page = new Page();
        $this->page->result = '';
    }
    
    public function authForm(): Creator
    {
        $temp = '<p>Авторизация: </p>'.PHP_EOL;
        $temp .= '<p>'.$this->page->input('text', 'login').'</p>'.PHP_EOL;
        $temp .= '<p>'.$this->page->input('password', 'pass').'</p>'.PHP_EOL;
        $temp .= '<p>'.$this->page->input('submit', 'submin', 'Войти').'</p>'.PHP_EOL;
        $temp = $this->page->wrapForm('auth', $temp).PHP_EOL;
        $this->page->result .= $temp;
        return $this;
    }
    
    public function header(string $logo): Creator
    {
        $temp = "Стандартная страница: $logo";
        $this->page->result .= $this->page->wrapDiv($temp).PHP_EOL;
        return $this;
    }
    
    public function footer(string $phone): Creator
    {
        $temp = "Телефон нашей компании: $phone";
        $this->page->result .= $this->page->wrapDiv($temp).PHP_EOL;
        return $this;
    }
    
    public function wrapPage(): Creator
    {
        $this->page->result = $this->page->top.PHP_EOL.$this->page->result.PHP_EOL.$this->page->bottom.PHP_EOL;
        return $this;
    }
    
    public function get(): string
    {
        $res = $this->page->result;
        $this->page->result = '';
        return $res;
    }

}

class Page {
    
    public $result;

    public $top = '<!DOCTYPE html>
    <html lang="ru">
    <head>
        <title>Тестовая страница</title>
    </head>
    <body>';
    
    public $bottom = '</body>
    </html>';
    
    public function input($type, $name, $value = ''): string
    {
        $res = '<input type="'.$type.'" name="'.$name.'"';
        if (isset($value)) {
            $res .= ' value="'.$value.'"';
        }
        $res .= '>';
        return $res;
    }
    
    public function wrapForm($name, $data)
    {
        $start = '<form name="'.$name.'" method="post" action="">'.PHP_EOL;
        $end = '</form>'.PHP_EOL;
        return $start.$data.$end;
    }
    
    public function wrapDiv($data)
    {
        $start = '<div>'.PHP_EOL;
        $end = '</div>'.PHP_EOL;
        return $start.$data.PHP_EOL.$end;
    }

}


class Director
{
    private $creator;
    
    public function __construct(Creator $creator)
    {
        $this->creator = $creator;
    }
    
    public function createStandardPage()
    {
        echo $this->creator
                ->header('Кампания')
                ->authForm()
                ->footer('222-323')
                ->wrapPage()
                ->get();
    }
}

$creator = new StandardCreator;
$a = new Director($creator);
$a->createStandardPage();
?>
