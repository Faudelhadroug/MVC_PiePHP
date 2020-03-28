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
        if (isset($_POST['email-form-register']) && isset($_POST['password-form-register']))
        {
            $this->email = $_POST['email-form-register'];
            $this->password = $_POST['password-form-register'];
            $UserModel = new \Model\UserModel($this->email, $this->password);
            $UserModel->save();
            $this->view = 'show';
            unset($UserModel);
            //$this->scope = [$UserModel->getEmail()];
        }
        else
        {
            echo '404';
        }
    }
    public function loginAction()
    {
        $this->view = 'login';
    }
    public function loginUserAction()
    {
        if (isset($_POST['email-form-login']) && isset($_POST['password-form-login']))
        {
            $this->email = $_POST['email-form-login'];
            $this->password = $_POST['password-form-login'];
            $UserModel = new \Model\UserModel($this->email, $this->password);
            $connexion = $UserModel->connexion();
            if (isset($connexion[0]) == true)
            {
                echo 'connexion réussi';
            }
            else
            {
                echo '404';
            }
            $this->view = 'show';
            unset($UserModel);
             //$this->scope = [$UserModel->connexion()];
        }
        else
        {
            echo '404';
        }
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