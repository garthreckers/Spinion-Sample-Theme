<?php
namespace Controllers;

use Spinion\Controller;

class FourOhFour extends Controller
{
    public function showPage()
    {
        $this->render('404');
    }
}