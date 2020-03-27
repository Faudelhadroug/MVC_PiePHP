<?php

namespace Controller;

class UserController extends \Core\Controller
{
    public function indexAction()
    {
        echo '<br> IndexAction de la class User : sexy mec <br><br>';
    }
    public function addAction()
    {
        echo '<br> addAction de la class User : salut bravo bg <br><br> hop';
        echo self::render('index');
        //echo $this->render('index');
    }
    public function registerAction()
    {
        $UserModel = new UserModel();
        var_dump($_POST);
    }

    public function __destruct()
    {
        
        //echo $this->render('index');
    }

    public function cacaAction()
    {
        echo '<br> caca de la class User : caca cacaacacacac caca <br><br>';
    }
}