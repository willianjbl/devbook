<?php

namespace src\helpers;

use core\Session;
use src\models\User;

class LoginHelper
{
    public static function checkLogin()
    {
        if (!empty(Session::get('TOKEN'))) {
            $token = Session::get('TOKEN');
            $data = User::select()->where('token', $token)->one();

            if (count($data) > 0) {
                $user = new User();
                $user->setId($data['id']);
                $user->setEmail($data['email']);
                $user->setName($data['name']);
                $user->setBirthDate($data['birthdate']);
                $user->setCity($data['city']);
                $user->setWork($data['work']);
                $user->setAvatar($data['avatar']);
                $user->setCover($data['cover']);
                $user->setToken($data['token']);

                return $user;
            }
        }
        return false;
    }

    public static function verifyLogin(string $email, string $password)
    {
        $user = User::select()
            ->where('email', $email)
            ->one();

        if (!empty($user) && count($user) > 0) {
            if (password_verify($user['password'], $password)) {
                $token = md5(time() . rand(0, 99999). $user['email']);

                User::update()
                    ->set('token', $token)
                    ->where('email', $email)
                    ->execute();

                return $token;
            }
        }
        return false;
    }
}
