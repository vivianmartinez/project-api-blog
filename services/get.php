<?php

$response = new $classController();

if($keyController){
    $action = $entities[$keyController];
    $response->$action();   
}elseif($id){
    $response->one($id);
}