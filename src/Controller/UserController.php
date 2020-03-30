<?php

namespace Controller;

class UserController extends \Core\Controller
{
    private $Request;

    public function __construct()
    {
        $this->Request = new \Core\Request();
        //$this->Request->POST
    }
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
        if (isset($this->Request->POST['email-form-register']) && isset($this->Request->POST['password-form-register']))
        {
            $this->email = $this->Request->POST['email-form-register'];
            $this->password = $this->Request->POST['password-form-register'];
            $UserModel = new \Model\UserModel($this->email, $this->password);
            $idUser = $UserModel->createUser();
            var_dump($idUser);
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
        $UserModel = new \Model\UserModel();
        // $deleteUser = $UserModel->deleteUser();
        // var_dump($deleteUser);
        // $updateUser = $UserModel->updateUser();
        // var_dump($updateUser);
        // $readUser = $UserModel->readUser();
        // var_dump($readUser);
        $this->view = 'login';
        unset($UserModel);
    }
    public function loginUserAction()
    {
        if (isset($this->Request->POST['email-form-login']) && isset($this->Request->POST['password-form-login']))
        {
            $this->email = $this->Request->POST['email-form-login'];
            $this->password = $this->Request->POST['password-form-login'];
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