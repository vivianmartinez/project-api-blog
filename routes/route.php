<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:','GET,POST,PUT,DELETE');
header('Content-Type: application/json');

require_once 'services/json-response/json-response.php';
require_once 'config/connect.php';
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

$classController = ucfirst($controller).'Controller';
$id = isset($_GET['id']) ? $_GET['id'] : false;

$messageError = [
    'error' => true,
    'status' => 400,
    'message' => 'Bad request'
];

if(!$controller || !class_exists($classController)){
    return JsonResponse::view($messageError,400);
}

//if((class_exists($classController) && $id) || (in_array($controller,$entities) && !$id)){
if((class_exists($classController) && $id && !$keyController) || ($keyController && !$id)){
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
        default:
            return JsonResponse::view($messageError,400);
    }  
}else{
    return JsonResponse::view($messageError,400);
}
