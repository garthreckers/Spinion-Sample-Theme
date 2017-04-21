<?php
namespace Controllers;

use Spinion\Controller;

class Home extends Controller
{
    public function showPage()
    {
        $this->render('home');
    }
}