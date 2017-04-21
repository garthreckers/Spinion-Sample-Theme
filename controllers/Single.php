<?php
namespace Controllers;

use Spinion\Controller;

class Single extends Controller
{
    public function showPage()
    {
        $this->addContext('post', $this->getPost());
        
        $this->render('single');
    }
}