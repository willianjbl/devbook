<?php

namespace src\controllers;

use core\Controller;
use core\Session;
use src\helpers\LoginHelper;

class UserController extends Controller
{
    public function signin()
    {
        $flash = Session::get('FLASH_MSG') ?? null;
        if (!empty(Session::get('FLASH_MSG'))) {
            Session::delete('FLASH_MSG');
        }
        $this->render('user/login', ['flash' => $flash]);
    }

    public function signinAction()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!empty($email) && !empty($password)) {
            $token = LoginHelper::verifyLogin($email, $password);
            
            if ($token) {
                Session::set('TOKEN', $token);
                $this->redirect('/');
            } else {
                Session::set('FLASH_MSG', 'E-mail ou senha inválido(s)!');
                $this->redirect('/login');
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function signup()
    {

    }
}