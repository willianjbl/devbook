<?php

namespace src\controllers;

use core\{ 
    Controller,
    Session
};
use src\helpers\{
    DateHelper,
    LoginHelper,
    MessageHelper
};

class UserController extends Controller
{
    public function signin()
    {
        $this->render('user/signin', ['flash' => MessageHelper::catchMessage()]);
    }

    public function signinAction()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if ($email && $password) {
            $token = LoginHelper::verifyLogin($email, $password);
            
            if ($token) {
                Session::set('TOKEN', $token);
                $this->redirect('/');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'E-mail ou senha inválido(s)!');
                $this->redirect('/signin');
            }
        } else {
            $this->redirect('/signin');
        }
    }

    public function signup()
    {
        $this->render('user/signup', ['flash' => MessageHelper::catchMessage()]);
    }

    public function signupAction()
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING);

        if ($name && $email && $password && $birthdate) {
            if (!LoginHelper::emailExists($email)) {
                $birthdate = DateHelper::americanDateConvert($birthdate);

                if (!$birthdate) {
                   $token = LoginHelper::addUser($name, $email, $password, $birthdate);
                   Session::set('TOKEN', $token);
                   MessageHelper::flashMessage(MESSAGE_SUCCESS, "Bem Vindo(a) $name!");
                   $this->redirect('/');
                } else {
                    MessageHelper::flashMessage(MESSAGE_ERROR, 'Data de nascimento inválida!');
                    $this->redirect('/signup');
                }
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'E-mail já cadastrado!');
                $this->redirect('/signup');
            }
        } else {
            MessageHelper::flashMessage(MESSAGE_ERROR, 'Todos campos precisam estar preenchidos');
            $this->redirect('/signup');
        }
    }
}