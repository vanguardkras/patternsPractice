<?php

abstract class CheckerCreator 
{
    private $req;
    
    abstract public function createTest(): Checker;
    
    public function check($current): string {
        return $this->createTest()->getReq($current);
    }
}

class PteCheckerCreator extends CheckerCreator
{
    private $req;
    private $obj = false;
    
    public function __construct() {
        $this->req = 65;
    }
    
    public function createTest(): Checker {
        if(!$this->obj) {
            $this->obj = new PteChecker($this->req);
        }
        return $this->obj;
    }
}

class IeltsCheckerCreator extends CheckerCreator
{
    private $req;
    
    public function __construct() {
        $this->req = 7;
    }
    
    public function createTest(): Checker {
        return new IeltsChecker($this->req);
    }
}

interface Checker
{
    public function getReq($current): string;
}

class PteChecker implements Checker
{
    private $req;
    
    public function __construct($req) {
        $this->req = $req;
    }
    
    public function getReq($current): string
    {
        if ($this->req <= $current && $current <= 90) {
            return 'Вы набрали достаточно баллов на PTE';
        } elseif ($current > 90) {
            return 'PTE не подразумевает такое коилчество баллов';
        } else {
            return 'К сожалению, вы набрали недостаточно баллов на PTE';
        }
    }
    
}

class IeltsChecker implements Checker
{
    private $req;
    
    public function __construct($req) {
        $this->req = $req;
    }
    
    public function getReq($current): string
    {
        if ($this->req <= $current && $current <= 9) {
            return 'Вы набрали достаточно баллов на IELTS';
        } elseif ($current > 9) {
            return 'Столько баллов невозможно набрать на IELTS';
        } else {
            return 'Вы не набрали недостаточно баллов на IELTS';
        }
    }
}

if(isset($_POST['Submit'])) {
    $a = new PteCheckerCreator;
    echo $a->check($_POST['par']);
    echo $a->check($_POST['par']);
}

?>
<form action="" method="post">
    <input type="number" name="par">
    <input type="submit" name="Submit">
</form>