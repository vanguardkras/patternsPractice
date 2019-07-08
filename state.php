<?php

class InfoGiver
{
    private $rights;
    
    public function __construct(Rights $rights)
    {
        $this->rights = $rights;
        $this->rights->changeGiver($this);
    }
    
    public function getSecrets(): string
    {
        return $this->rights->getForbidden();
    }
    
    public function getAgents(): string
    {
        return $this->rights->getNames();
    }
    
    public function changeRights(Rights $rights)
    {
        $this->rights = $rights;
        $this->rights->changeGiver($this);
    }
}


abstract class Rights
{
    protected $infogiver;
    
    public function changeGiver(InfoGiver $giver) 
    {
        $this->infogiver = $giver;
    }
    abstract public function getForbidden();
    abstract public function getNames();
}

class Admin extends Rights
{
    public function getForbidden() 
    {
        $this->infogiver->changeRights(new User);
        return 'The enemy HQ is on the north pole!<br>';
    }
    
    public function getNames() 
    {
        $this->infogiver->changeRights(new User);
        return 'Smith, Smiths and Mr. Smith.<br>';
    }
}

class User extends Rights
{
    public function getForbidden() 
    {
        return 'It is too secret for you!<br>';
    }
    
    public function getNames() 
    {
        return 'Unauthorized breach attempt!<br>';
    }
}

$a = new InfoGiver(new Admin);

echo $a->getSecrets();
echo $a->getAgents();
$a->changeRights(new Admin);
echo $a->getAgents();
echo $a->getSecrets();
