<?php
use core\Router;

$router = new Router();

// * ACCESS
$router->get('/', 'HomeController@index');
$router->get('/signin', 'UserController@signin');
$router->post('/signin', 'UserController@signinAction');
$router->get('/signup', 'UserController@signup');
$router->post('/signup', 'UserController@signupAction');
$router->get('/signout', 'UserController@signout');

// $router->get('/search', '');

//* PROFILE
$router->get('/profile/{id}/friends', 'ProfileController@friends');
$router->get('/profile/{id}/follow', 'ProfileController@follow');
$router->get('/profile/friends', 'ProfileController@friends');
$router->get('/profile/{id}', 'ProfileController@index');
$router->get('/profile', 'ProfileController@index');
// $router->get('/settings', '');

// $router->get('/pictures/{id}', '');
// $router->get('/pictures', '');

$router->post('/post/new', 'PostController@new');
