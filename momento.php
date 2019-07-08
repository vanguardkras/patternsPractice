<?php

class UsefulClass
{
    private $text;
    
    public function __construct(string $text)
    {
        $this->text = $text;
    }
    
    public function toUp(): void
    {
        $this->text = strtoupper($this->text);
        $this->text = str_split($this->text);
        $this->text = implode('_', $this->text);
    }
    
    public function limit(int $length)
    {
        $this->text = substr($this->text, 0, $length);
        $this->text .= ' ...';
    }
    
    public function save(): Safe
    {
        return new Saver($this->text);
    }
    
    public function restore(Saver $saver): void
    {
        $this->text = $saver->getText();
    }
    
    public function getText()
    {
        echo $this->text;
    }
}

interface Safe
{
    public function getSave();
}

class Saver implements Safe
{
    private $text;
    private $date;
    
    public function __construct($text)
    {
        $this->text = $text;
        $this->date = date('d-m-Y H:i:s', time());
    }
    
    public function getText(): string
    {
        return $this->text;
    }
    
    public function getSave(): string
    {
        return $this->date . ': ' . substr($this->text, 0, 5) . '...';
    }
}

class SaveProcessor
{
    private $saves = [];
    
    private $usefulclass;
    
    public function __construct(UsefulClass $usefulclass)
    {
        $this->usefulclass = $usefulclass;
    }
    
    public function backup()
    {
        $this->saves[] = $this->usefulclass->save();
    }
    
    public function cancel()
    {
        if (count($this->saves) > 0) {
            $last_save = array_pop($this->saves);
            $this->usefulclass->restore($last_save);
        }
    }
    
    public function showHistory(): void
    {
        echo 'Changes: <br>';
        
        foreach ($this->saves as $s) {
            echo $s->getSave();
            echo '<br>';
        }
        
    }
}

$text = 'Mother is washing a frame and sucks a doughnut';

$article = new UsefulClass($text);
$backups = new SaveProcessor($article);

$backups->backup();
$article->toUp();
$backups->backup();
$article->limit(20);
$backups->backup();
$article->limit(10);
$backups->showHistory();
echo '<br> Real result: ';
echo $article->getText();
$backups->cancel();
echo '<br> Real result: ';
echo $article->getText();
$backups->cancel();
echo '<br> Real result: ';
echo $article->getText();
$backups->cancel();
echo '<br> Real result: ';
echo $article->getText() . '<br>';