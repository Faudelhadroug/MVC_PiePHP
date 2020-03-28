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
        $this->view = 'register';
    }
    public function registerAction()
    {
        $this->email = $_POST['email-form-register'];
        //$UserModel->email = $this->email;
        $this->password = $_POST['password-form-register'];
        $UserModel = new \Model\UserModel($this->email, $this->password);
        $save = $UserModel->save();
        $this->view = 'show';
        //$this->scope = [$UserModel->getEmail()];
        //$this->scope = [\Model\UserModel::__setEmail($this->email), \Model\UserModel::__getEmail()];
    }

    public function __destruct()
    {
        isset($this->view) ? $this->view : $this->view = 'index';
        isset($this->scope) ? $this->scope : $this->scope = [];
        echo $this->render($this->view, $this->scope);

    }

    public function cacaAction()
    {
        echo '<br> caca de la class User : caca cacaacacacac caca <br><br>';
    }
}