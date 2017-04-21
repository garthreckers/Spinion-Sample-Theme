<?php
namespace Controllers;

use Spinion\Controller;

class Archive extends Controller
{
    public function showPage()
    {
        $this->addContext('posts', $this->getPosts());

        $this->render('archive');
    }
}