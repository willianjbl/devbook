<?php

require '../vendor/autoload.php';
require '../src/routes.php';
require '../core/constantes.php';

\core\Session::start();

$router->run( $router->routes );
