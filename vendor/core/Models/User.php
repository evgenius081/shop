<?php

namespace core\Models;

class User extends \core\Model{

    const USER_DATA_CAN_BE_USED = 0;
    const USER_NAME_IS_ENGAED = 1;
    const USER_EMAIL_IS_ALREADY_REGISTERED = 2;
    const USER_PHONE_IS_ALREADY_REGISTERED = 3;

    public function getUserInfo($login){
        $db = $this->setInstance();
        $results = $db->table('wp_users')->where(['user_login'], '=', [$login])->getSome()[0];
        if(count($results) == 0){
            return 'no_login';
        }else{
            return $results;
        }
    }

    public function login($user){
        $_SESSION['token'] = $this->generateToken($user['ID']);
        $_SESSION['uid'] = $user['ID'];
        $_SESSION['creator'] = $user['user_login'];
    }

    private function generateToken($userID){
        return  md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].$userID);
    }

    public function logout(){
        unset($_SESSION['token']);
        unset($_SESSION['uid']);
        unset($_SESSION['creator']);
    }

    public function checkUserData($userLogin, $userEmail, $userPhone){
        $db = $this->setInstance();
        $results = $db->table('wp_users')->where(['user_login', 'user_email', 'user_phone'], '=', [$userLogin, $userEmail,$userPhone], 'OR')->getSome();
        if(empty($results)){
            return self::USER_DATA_CAN_BE_USED;
        }else{
            $resopnd = '';
            foreach ($results as $person){
                if(in_array($userLogin, $person)){
                    $respond .= self::USER_NAME_IS_ENGAED;
                }
                if(in_array($userEmail, $person)){
                    $respond .= self::USER_EMAIL_IS_ALREADY_REGISTERED;
                }
                if(in_array($userPhone, $person)){
                    $respond .= self::USER_PHONE_IS_ALREADY_REGISTERED;
                }
            }
            return $respond;
        }
    }

    public function register($person){
        $db = $this->setInstance();
        $registeredUserID = $db->table('wp_users')->from('(ID, user_login, user_pass, user_nicename, user_email, user_phone, user_url, user_registered, user_activation_key, user_status, display_name)')->set([null, $person["login"], $person["password"], $person["login"], $person["email"], $person['phone'], "", date("Y-m-d H:i:s"), "", 0, $person["login"]]);
        if($registeredUserID){
            return $registeredUserID;
        }else{
            return 0;
        }
    }
}