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
                $user->setId($data['id'] ?? null);
                $user->setEmail($data['email'] ?? null);
                $user->setName($data['name'] ?? null);
                $user->setBirthDate($data['birthdate'] ?? null);
                $user->setCity($data['city'] ?? null);
                $user->setWork($data['work'] ?? null);
                $user->setAvatar($data['avatar'] ?? null);
                $user->setCover($data['cover'] ?? null);
                $user->setToken($data['token'] ?? null);

                return $user;
            }
        }
        return false;
    }

    public static function verifyLogin(string $email, string $password)
    {
        $user = self::emailExists($email, true);

        if ($user) {
            if (password_verify($user['password'], $password)) {
                $token = md5(time() . rand(0, 99999) . $user['email']);

                User::update()
                    ->set('token', $token)
                    ->where('email', $email)
                    ->execute();

                return $token;
            }
        }
        return false;
    }

    public static function emailExists(string $email, bool $returnValues = false): bool
    {
        $user = User::select()
            ->where('email', $email)
            ->one();

        if ($returnValues) {
            return (!empty($user) && count($user) > 0) ? $user : false;
        }        
        return (!empty($user) && count($user) > 0) ? true : false;
    }

    public static function addUser(string $name, string $email, string $password, string $birthdate): string
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time() . rand(0, 99999) . $email);

        User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();
        
        return $token;
    }
}
