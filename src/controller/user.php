<?php
require (__DIR__ . '/../system/config/database.php');
require (__DIR__ . '/../system/engine/auth.php');

use \Auth as Auth;
use \Database as Database;

class User extends Auth
{
    /* protected $db;
    protected $auth; */

    public function __construct() 
    {
        $database = new \Database();
        $db = $database->getConnection();
        $auth = new \Auth($db);
    }

    public function registerUser($data) 
    {
        if ($data) {	
            if($data['password'] == $data['confirm_password']) {
                $auth->first_name = $data['first_name'];
                $auth->last_name = $data['last_name'];
                $auth->email = $data['email'];
                $auth->password = $data['password'];

                $auth->register();
            } else {
                $_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> Error: Passwords do not match!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
                header("location:register.php");
            }
            
            if ($auth->register()) {
                if($auth->login($auth->email, $auth->password)){
                    $_SESSION['logged'] = true;
                    $_SESSION['last_activity'] = time();
                    $_SESSION['expire_time'] = (1 * 60 * 60) + 1;
                    $_SESSION['username'] = $auth->first_name . ' ' . $auth->last_name;
                    $_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Successfully logged in <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
                    header("location:index.php");
                }
            } else {
                echo "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> " . $_SESSION['error'] . "<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
            }
        }
    }
    
}
