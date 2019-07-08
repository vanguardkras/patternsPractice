<?php

abstract class Page
{
    protected $draw;

    public function __construct(Drawer $draw)
    {
        $this->draw = $draw;
    }
    
    abstract public function show();
}

class MainPage extends Page
{
    public function show()
    {
        $res = '';
        $res .= $this->draw->header();
        $res .= $this->draw->mainInformation();
        $res .= $this->draw->footer();
        return $res;
    }
}

class BlogPage extends Page
{
    public function show()
    {
        $res = '<h1>BLOG</h1><br><br>';
        $res .= $this->draw->mainInformation();
        $res .= $this->draw->footer();
        return $res;
    }
}

abstract class Drawer
{
    public function header()
    {
        return '<h1>Это заголовок</h1>';
    }
    
    public function footer()
    {
        return '<h3>Copyright</h3>';
    }
    
    abstract public function mainInformation();
}

class NewsDrawer extends Drawer
{
    public function mainInformation() 
    {
        return '<p>Here you can read recent news about everything</p>';
    }
}

class BlogDrawer extends Drawer
{
    public function mainInformation() 
    {
        return '<p>Here you can see a lot of articales of our users</p>';
    }
}

$a = new MainPage(new BlogDrawer);
echo $a->show();
