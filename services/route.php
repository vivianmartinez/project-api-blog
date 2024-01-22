<?php

require_once 'api/categoryController.php';

$route =  $_SERVER['REQUEST_URI'];
print_r($route);
echo '<hr>';
print_r($_GET);