<?php

require_once 'api/categoryController.php';
require_once 'api/postController.php';
require_once 'api/userController.php';

$route =  $_SERVER['REQUEST_URI'];

$controller = isset($_GET['controller']) ? $_GET['controller'] : false;
$entities = ['user'=>'users','category' =>'categories','post' =>'posts'];
$keyController =  array_search($controller,$entities);
if($keyController){
    $controller = $keyController;
}
if($controller){
    
    $classController = ucfirst($controller).'Controller';
    $method = isset($_GET['method']) ? $_GET['method'] : false;
   
    //if((class_exists($classController) && $method) || (in_array($controller,$entities) && !$method)){
    if((class_exists($classController) && $method && !$keyController) || ($keyController && !$method)){
        switch ($_SERVER['REQUEST_METHOD']){
            case 'GET':
                require_once 'services/get.php';
                break;
            case 'POST':
                require_once 'services/post.php';
                break;
            case 'DELETE':
                echo 'DELETE';
                break;
            case 'PUT':
                echo 'PUT';
                break;
        }  
    }

     
}