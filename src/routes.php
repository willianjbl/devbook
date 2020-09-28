<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'UserController@signin');
$router->post('/login', 'UserController@signinAction');
$router->get('/cadastro', 'UserController@signup');