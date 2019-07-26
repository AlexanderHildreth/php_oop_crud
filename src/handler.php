<?php
namespace Handler;

// This file handles the connection between front and backen files.
require (__DIR__ . '/controller/user.php');

switch($_GET['method']){
    case 'register':
    register();
    break;
    default:
    echo "Unknown method";
    break;
}

// User orientated code
use \User;
$user = new \User;

// For registration
function register() 
{
    $data = $_GET;
    try {
        $user->registerUser($data);
    } catch (\Throwable $th) {
        return $th->getMessage;
    }
}
