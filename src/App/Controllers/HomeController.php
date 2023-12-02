<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function home()
    {
        $this->view->render("homepage.php", ['title' => "Hello World"]);
    }
}
