<?php

namespace src\helpers;

use core\Session;
use src\models\User;

class UserHelper
{
    /**
     * Verify if session token is valid.
     * @return bool|User Returns User object if successful, false otherwise.
     */
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

    /**
     * Verify login credentials and validates the user password.
     * @param string $email User email.
     * @param string $password User password.
     * @return bool|string Returns the token if successful, false otherwise.
     */
    public static function verifyLogin(string $email, string $password)
    {
        $user = self::emailExists($email, true);

        if ($user) {
            if (password_verify($password, $user['password'])) {
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

    /**
     * Verify if user exists by it ID, it can return user data if second parameter is true.
     * @param int $id User ID.
     * @param bool $returnValues Rather it will return user data or not.
     * @return bool|User Returns User object if successful, false otherwise.
     */
    public static function idExists(int $id, bool $returnValues = false)
    {
        $userQuery = User::select()
            ->where('id', $id)
            ->one();

        $user = new User();
        $user->setId($userQuery['id'] ?? null);
        $user->setEmail($userQuery['email'] ?? null);
        $user->setName($userQuery['name'] ?? null);
        $user->setBirthDate($userQuery['birthdate'] ?? null);
        $user->setCity($userQuery['city'] ?? null);
        $user->setWork($userQuery['work'] ?? null);
        $user->setAvatar($userQuery['avatar'] ?? null);
        $user->setCover($userQuery['cover'] ?? null);

        if ($returnValues) {
            return (!empty($userQuery['id'])) ? $user : false;
        }
        return (!empty($userQuery['id'])) ? true : false;
    }

    /**
     * Verify if user exists by it Email, it can return user data if second parameter is true.
     * @param int $email User Email.
     * @param bool $returnValues Rather it will return user data or not.
     * @return bool|array Returns User data if successful, false otherwise.
     */
    public static function emailExists(string $email, bool $returnValues = false)
    {
        $user = User::select()
            ->where('email', $email)
            ->one();

        if ($returnValues) {
            return (!empty($user) && count($user) > 0) ? $user : false;
        }        
        return (!empty($user) && count($user) > 0) ? true : false;
    }

    /**
     * Adds a new user to the database.
     * @param string $name User complete name.
     * @param string $email User E-mail.
     * @param string $password User password.
     * @param string $birthdate User birth date.
     * @return string Returns user session token.
     */
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
