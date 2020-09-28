<?php

require '../vendor/autoload.php';
require '../src/routes.php';

\core\Session::start();

$router->run( $router->routes );
