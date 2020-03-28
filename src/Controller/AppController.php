<?php

namespace Controller;

class AppController extends \Core\Controller
{
    public function indexAction()
    {
        echo '<br> IndexAction de la class App <br>';
        $this->view = 'index';
    }
    public function __destruct()
    {
        isset($this->view) ? $this->view : $this->view = 'index';
        echo $this->render($this->view);

    }
}