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
        $instance = new \Model\UserModel([]);
        $users = $instance->read_all();
        $this->view = 'index';
        $this->scope = ['users' => $users]; 
    }
    public function addAction()
    {
        //echo '<br> addAction de la class User : salut bravo bg <br><br> hop';
        $this->view = 'register';
    }

    public function registerAction()
    {
        if (isset($this->Request->POST['email']) && isset($this->Request->POST['password']))
        {
            $UserModel = new \Model\UserModel($this->Request->POST);
            $idUser = $UserModel->create();
            $this->view = 'show';
            unset($UserModel);
        }
        else
        {
            echo '404';
        }
    }
    public function deleteAction($id)
    {
        $UserModel = new \Model\UserModel(['id' => $id]);
        $delete = $UserModel->delete();   
        echo "<br> $id <br>";
        if ($delete == true)
        {
            $msg = 'Success : User has been correclty deleted';
        }
        else
        {
            $msg = 'Error : Operation failed';
        }
        $this->view = 'show'; 
        $this->scope = ['msg' => $msg]; 
    }

    public function loginAction()
    {

        $this->view = 'login';
        unset($UserModel);
        /*       
         $UserModel = new \Model\UserModel(['email' => 'workfine@bg.tkt', 'password' => 'secret']);
        $find = $UserModel->connexion();
        var_dump($find); 
        */
    }
    public function loginUserAction()
    {
        if (isset($this->Request->POST['email']) && isset($this->Request->POST['password']))
        {
            $UserModel = new \Model\UserModel($this->Request->POST);
            $connexion = $UserModel->connexion();
            if (isset($connexion) == true)
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

    public function detailsAction($id = null)
    {
        if ($id !== null)
        {
            $UserModel = new \Model\UserModel(['id' => $id]);
            // $article = new \Model\ArticleModel(['id' => 1]);
            //  var_dump($UserModel->articles[0]->content);
            //  var_dump($UserModel->promos->year);
            //  var_dump($UserModel->colors);
            $this->scope = ['UserModel' => $UserModel]; 
            $this->view = 'details'; 
        }
        else
        {
            $this->view = 'show'; 
        }
        //$this->scope = ['msg' => $msg]; 
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