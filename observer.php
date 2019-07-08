<?php

class Administrator implements \SplSubject
{
    private $observers = [];
    private $storage;
    public $data;
    
    public function __construct()
    {
        $this->storage = new \SplObjectStorage();
    }
    
    public function attach(\SplObserver $object): void 
    {
        $this->storage->attach($object);
    }
    
    public function detach(\SplObserver $observer): void 
    {
        $this->storage->detach($object);
    }
    
    public function notify(): void 
    {
        foreach ($this->storage as $storage)
        {
            $storage->update($this);
        }
    }
    
    public function change($data)
    {
        $this->data = strtoupper($data);
        $this->notify();
    }
}

class Echoer implements \SplObserver
{
    public function update(\SplSubject $subject): void 
    {
        echo 'New Data is: ' . $subject->data;
        echo '<br>';
    }
}

class Logger implements \SplObserver
 {

    public function update(\SplSubject $subject): void {
        $data = date('H:i:s', time());
        $data .= ': Changed data to ';
        $data .= $subject->data;
        file_put_contents('observer_log.txt', $data . PHP_EOL, FILE_APPEND);
    }

}

$admin = new Administrator();

$a = new Echoer();
$b = new Logger();

$admin->attach($a);
$admin->attach($b);

$data = 'Random text without any sense';
$admin->change($data);
$data = 'One more time';
$admin->change($data);
$data = 'One more time';
$admin->change($data);
$data = 'One more time';
$admin->change($data);
