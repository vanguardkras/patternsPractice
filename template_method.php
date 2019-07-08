<?php

abstract class Former
{
    private $result = '';
    
    public function makeForm(): string
    {
        return $this->wrap($this->result);
    }
    
    public function wrap(string $data): string
    {
        return '<form action="" method="post">' . PHP_EOL . 
                $data . '</form>' . PHP_EOL;
    }
    
    public function addInput(string $type, string $name, string $value = ''): void
    {
        $this->result .= "<input type=\"$type\" name=\"$name\" value=\"$value\">" . PHP_EOL;
    }
}

class GetFormer extends Former
{
    public function wrap($data): string
    {
        return '<form action="" method="get">' . PHP_EOL . 
                $data . '</form>' . PHP_EOL;
    }
}

$a = new GetFormer;
$a->addInput('text', 'text');
$a->addInput('submit', 'submit', 'Submit');
echo $a->makeForm();