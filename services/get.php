<?php

//print_r($_GET);
//echo $controller;

if($keyController){
    $response = new $classController();
    $action = $entities[$keyController];
    $response->$action();
}