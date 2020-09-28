<?php

namespace src\controllers;

use core\Controller;
use src\models\User;

class UserController extends Controller
{
    public function signin()
    {
        $this->render('user/login');
    }

    public function signinAction()
    {
        echo 'Login recebido';
    }

    public function signup()
    {

    }
}