<?php

require '../vendor/autoload.php';
require '../src/routes.php';
require '../core/constantes.php';
require '../core/config.php';

\core\Session::start();

$router->run($router->routes);
