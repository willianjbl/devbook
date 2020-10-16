<?php

namespace src\helpers;

use core\Session;
use src\models\User;
use src\models\User_Relation;

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
    public static function idExists(int $id, bool $returnValues = false, bool $returnRelations = false)
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
        $user->followers = [];
        $user->following = [];
        $user->pictures = [];

        if ($returnRelations) {
            $followers = User_Relation::select()->where('user_to', $id)->get();
            foreach ($followers as $follower) {
                $userData = User::select()->where('id', $follower['user_from'])->one();
                $newUser = new User();
                $newUser->setId($userData['id'] ?? null);
                $newUser->setName($userData['name'] ?? null);
                $newUser->setAvatar($userData['avatar'] ?? null);

                $user->followers[] = $newUser;
            }

            $follows = User_Relation::select()->where('user_from', $id)->get();
            foreach ($follows as $following) {
                $userData = User::select()->where('id', $following['user_to'])->one();
                $newUser = new User();
                $newUser->setId($userData['id'] ?? null);
                $newUser->setName($userData['name'] ?? null);
                $newUser->setAvatar($userData['avatar'] ?? null);

                $user->following[] = $newUser;
            }

            $user->pictures = PostHelper::getPicturesFrom($id);
        }

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

    public static function isFollowing($loggedUser, $user): bool
    {
        $data = User_Relation::select()
            ->where('user_from', $loggedUser)
            ->where('user_to', $user)
            ->one();

        if ($data) {
            return true;
        }
        return false;
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

    public static function follow(int $loggedUser, int $user): void
    {
        User_Relation::insert([
            'user_from' => $loggedUser,
            'user_to' => $user
        ])->execute();
    }

    public static function unfollow(int $loggedUser, int $user): void
    {
        User_Relation::delete([
            'user_from' => $loggedUser,
            'user_to' => $user
        ])->execute();
    }

    public static function searchUser(string $term): array
    {
        $users = [];
        $data = User::select()->where('name', 'LIKE', "%$term%")->get();

        if (count($data) > 0) {
            foreach ($data as $user) {
                $newUser = new User();
                $newUser->setId($user['id'] ?? null);
                $newUser->setName($user['name'] ?? null);
                $newUser->setAvatar($user['avatar'] ?? null);
                
                $users[] = $newUser;
            }
        }

        return $users;
    }

    public static function updateUserInformation(
        int $id,
        string $name,
        string $email,
        string $birthdate,
        string $work,
        string $city
    ): void {
        User::update()
            ->set('name', $name)
            ->set('email', $email)
            ->set('birthdate', $birthdate)
            ->set('work', $work)
            ->set('city', $city)
            ->where('id', $id)
            ->execute();
    }

    public static function updateUserPassword(int $id, string $password): void
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        User::update()->set('password', $password)->where('id', $id)->execute();
    }
}
