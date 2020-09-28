<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'UserController@signin');
$router->get('/cadastro', 'UserController@signup');