<?php

namespace core\Controller;

class User extends \core\Controller{
    
    public function index(){
        $user = new \core\Models\User();
        if(isset($_POST["signup"])){
            $password = $user->getUserInfo($_POST['userlogin']);
            if($password != 'no_login'){
                if(password_verify($_POST['password'], $password['user_pass'])){
                   $user->login($password);
                    header('location: \\');
                }else{
                    $this->view('login');
                    echo "<div class='modal'><p>Wrong password, hacker)</p><i class='fal fa-times fa-2x'></i></div>";
                }
            }else{
                $this->view('login');
                echo "<div class='modal'><p>This login doesn`t exist!</p><i class='fal fa-times fa-2x'></i></div>";
            }
        }else{
            $this->view('login');
        }
    }

    public function cabinet(){
        $this->view('cabinet');
    }

    public function logout(){
        $user = new \core\Models\User();
        $user->logout();
        header('location: \\');
    }

    public function register(){
        $person = new \core\Models\User();
        if(isset($_POST["signin"])){
            $respond = $person->checkUserName($_POST['userlogin']);
            if($respond == 0){
                $userName = $_POST['userlogin'];
                $userEmail = $_POST['email'];
                $userPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user=[
                    'login' => $userName, 
                    'email' => $userEmail,
                    'password' => $userPassword 
                ];
                $id = $person->register($user);
                if($id != 0){
                    $info = ['user_login' => $userName, 'ID' => $id];
                    $person->login($info);
                    header("location: \\");
                }else{
                    $this->view('register');
                    echo "<div class='modal'><p>Something gone wrong</p><i class='fal fa-times fa-2x'></i></div>";
                    die();
                }
            }else{
                $this->view('register');
                echo "<div class='modal'><p>This login is engaged. Try another one</p><i class='fal fa-times fa-2x'></i></div>";
                die();
            }
        }else{
            $this->view('register');
        }
    }
}