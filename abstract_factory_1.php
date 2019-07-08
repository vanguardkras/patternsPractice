<?php

abstract class Test
{
    abstract public function createL(): AbstractListening;
    abstract public function createR(): AbstractReading;
    abstract public function createW(): AbstractWriting;
    abstract public function createS(): AbstractSpeaking;
    
    public function checkAll(int $l, int $r, int $w, int $s)
    {
        
        echo $this->createL()->check($l);
        echo $this->createR()->check($r);
        echo $this->createW()->check($w);
        echo $this->createS()->check($s);
        
    }
}

class Pte extends Test
{
    private $max = 90;
    
    public function createL(): AbstractListening
    {
        return new PteListening($this->max);
    }
    
    public function createR(): AbstractReading
    {
        return new PteReading($this->max);
    }
    
    public function createW(): AbstractWriting
    {
        return new PteWriting($this->max);
    }
    
    public function createS(): AbstractSpeaking
    {
        return new PteSpeaking($this->max);
    }
}

class Ielts extends Test
{
    private $max = 9;
    
    public function createL(): AbstractListening
    {
        return new IeltsListening($this->max);
    }
    
    public function createR(): AbstractReading
    {
        return new IeltsReading($this->max);
    }
    
    public function createW(): AbstractWriting
    {
        return new IeltsWriting($this->max);
    }
    
    public function createS(): AbstractSpeaking
    {
        return new IeltsSpeaking($this->max);
    }
}

interface AbstractListening
{
    public function check(int $res): string;
}

class PteListening implements AbstractListening
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (90 >= $res && $res > 75) {
            return 'Вы сдали PTE-Listening успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в PTE-Listening<br>';
        } else {
            return 'Может быть повезет в следующий раз в PTE-Listening<br>';
        }
    }
}

class IeltsListening implements AbstractListening
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (9 >= $res && $res > 8) {
            return 'Вы сдали IELTS-Listening успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в IELTS-Listening<br>';
        } else {
            return 'Может быть повезет в следующий раз в IELTS-Listening<br>';
        }
    }
}

interface AbstractReading
{
    public function check(int $res): string;
}

class PteReading implements AbstractReading
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (90 >= $res && $res > 65) {
            return 'Вы сдали PTE-Reading успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в PTE-Reading<br>';
        } else {
            return 'Может быть повезет в следующий раз в PTE-Reading<br>';
        }
    }
}

class IeltsReading implements AbstractReading
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (9 >= $res && $res > 7) {
            return 'Вы сдали IELTS-Reading успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в IELTS-Reading<br>';
        } else {
            return 'Может быть повезет в следующий раз в IELTS-Reading<br>';
        }
    }
}

interface AbstractWriting
{
    public function check(int $res): string;
}

class PteWriting implements AbstractWriting
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (90 >= $res && $res > 65) {
            return 'Вы сдали PTE-Writing успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в PTE-Writing<br>';
        } else {
            return 'Может быть повезет в следующий раз в PTE-Writing<br>';
        }
    }
}

class IeltsWriting implements AbstractWriting
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (9 >= $res && $res > 7) {
            return 'Вы сдали IELTS-Writing успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в IELTS-Writing<br>';
        } else {
            return 'Может быть повезет в следующий раз в IELTS-Writing<br>';
        }
    }
}

interface AbstractSpeaking
{
    public function check(int $res): string;
}

class PteSpeaking implements AbstractSpeaking
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (90 >= $res && $res > 65) {
            return 'Вы сдали PTE-Speaking успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в PTE-Speaking<br>';
        } else {
            return 'Может быть повезет в следующий раз в PTE-Speaking<br>';
        }
    }
}

class IeltsSpeaking implements AbstractSpeaking
{
    private $max;
    
    public function __construct($max) {
        $this->max = $max;
    }
    
    public function check(int $res): string
    {
        if (9 >= $res && $res > 7) {
            return 'Вы сдали IELTS-Speaking успешно<br>';
        } elseif ($res > $this->max) {
            return 'Таких результатов не бывает в IELTS-Speaking<br>';
        } else {
            return 'Может быть повезет в следующий раз в IELTS-Speaking<br>';
        }
    }
}



if(isset($_POST['Submit'])) {
    $a = new Pte;
    $a->checkAll($_POST['L'], $_POST['R'], $_POST['W'], $_POST['S']);
}

?>
<form action="" method="post">
    L:<input type="number" name="L">
    R:<input type="number" name="R">
    W:<input type="number" name="W">
    S:<input type="number" name="S">
    <input type="submit" name="Submit">
</form>