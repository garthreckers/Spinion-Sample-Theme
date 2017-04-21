<?php
namespace Controllers;

use Spinion\Controller;

class Page extends Controller
{
    public function showPage()
    {
        $this->addContext('post', $this->getPost());
        
        $this->render('page');
    }
}