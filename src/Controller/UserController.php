<?php

namespace Controller;

class UserController extends \Core\Controller
{
    public function indexAction()
    {
        echo '<br> IndexAction de la class User : sexy mec <br><br>';
        $this->view = 'index';
    }
    public function addAction()
    {
        //echo '<br> addAction de la class User : salut bravo bg <br><br> hop';
        $this->view = 'login';
    }
    public function registerAction()
    {
        $UserModel = new UserModel();
        var_dump($_POST);
        $this->view = 'register';
    }

    public function __destruct()
    {
        isset($this->view) ? $this->view : $this->view = 'index';
        echo $this->render($this->view);

    }

    public function cacaAction()
    {
        echo '<br> caca de la class User : caca cacaacacacac caca <br><br>';
    }
}