<?php

require_once 'api/categorieController.php';

$route =  $_SERVER['REQUEST_URI'];
print_r($route);
print_r($_GET['view']);