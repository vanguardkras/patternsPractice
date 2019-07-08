<?php

abstract class FormBuild
{
    protected $name;
    protected $class;
    
    public function __construct(string $class, string $name)
    {
        $this->name = $name;
        $this->class = $class;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    abstract public function render(): string;
}

class Input extends FormBuild
{
    private $type;
    private $value;
    
    public function __construct(string $class, string $name, string $type, string $value = '') 
    {
        parent::__construct($class, $name);
        $this->type = $type;
        $this->value = $value;
    }
    
    public function render(): string
    {
        return "<input class='{$this->class}' name='{$this->name}' type='{$this->type}' value='{$this->value}'>".PHP_EOL;
    }
}

class Paragraph extends FormBuild
{
    private $data;
      
    public function render(): string
    {
        return "<p class='{$this->class}' name='{$this->name}'>{$this->data}</p>".PHP_EOL;
    }
}

abstract class Dom extends FormBuild
{
    public $elements =[];
    
    public function add(FormBuild $element): void
    {
        $name = $element->getName();
        $this->elements[$name] = $element;
    }
}

class Div extends Dom
{
    public function render(): string
    {
        $res = "<div class='{$this->class}' name='{$this->name}'>".PHP_EOL;
        foreach ($this->elements as $el) {
            $res .= $el->render();
        }
        $res .= '</div>'.PHP_EOL;
        return $res;
    }
}

$p = new Paragraph('p1', 'main', 'Это данные первого параграфа');
$in1 = new Input('i1', 'name', 'text');
$in2 = new Input('i1', 'submit', 'submit', 'Подтвердить');
$in3 = new Input('i1', 'current', 'date');

$div1 = new Div('div1', 'forms');
$div1->add($p);
$div1->add($in1);
$div1->add($in2);
$div2 = new Div('div2', 'date');
$div2->add($in3);
$div3 = new Div('div3', 'all');
$div3->add($div1);
$div3->add($div2);
echo $div3->render();