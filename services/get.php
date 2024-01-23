<?php

//print_r($_GET);
//echo $controller;
$response = new $classController();

if($keyController){
    
    $action = $entities[$keyController];
    $response->$action();
    
}elseif($id){
    $response->one($id);
}