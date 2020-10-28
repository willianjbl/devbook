<?php

namespace src\controllers;

use core\{ 
    Controller,
    Session
};
use src\helpers\{
    DateHelper,
    UserHelper,
    MessageHelper
};

class UserController extends Controller
{
    public function signin()
    {
        $this->render('user/signin');
    }

    public function signinAction(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? null;

        if ($email && $password) {
            $token = UserHelper::verifyLogin($email, $password);
            
            if ($token) {
                Session::set('TOKEN', $token);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Bem-vindo(a)!');
                $this->redirect('/');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'E-mail ou senha inválido(s)!');
                $this->redirect('/signin');
            }
        } else {
            $this->redirect('/signin');
        }
    }

    public function signup(): void
    {
        $this->render('user/signup');
    }

    public function signupAction(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) ?? null;
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? null;
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING) ?? null;

        if ($name && $email && $password && $birthdate) {
            if (!UserHelper::emailExists($email)) {
                $birthdate = DateHelper::americanDateConvert($birthdate);

                if ($birthdate) {
                   $token = UserHelper::addUser($name, $email, $password, $birthdate);
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
            MessageHelper::flashMessage(MESSAGE_WARNING, 'Todos campos precisam estar preenchidos');
            $this->redirect('/signup');
        }
    }

    public function signout(): void
    {
        Session::destroy();
        MessageHelper::flashMessage(MESSAGE_ERROR, 'Você foi desconectado(a)!');
        $this->redirect('/');
    }
}
