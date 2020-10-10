<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/signin', 'UserController@signin');
$router->post('/signin', 'UserController@signinAction');
$router->get('/signup', 'UserController@signup');
$router->post('/signup', 'UserController@signupAction');
$router->get('/signout', 'UserController@signout');

// $router->get('/search', '');
$router->get('/profile/{id}', 'ProfileController@index');
$router->get('/profile', 'ProfileController@index');
// $router->get('/friends', '');
// $router->get('/pictures', '');
// $router->get('/settings', '');

// $router->get('/following/{id}', '');
// $router->get('/following', '');
// $router->get('/pictures/{id}', '');
// $router->get('/pictures', '');

$router->post('/post/new', 'PostController@new');
