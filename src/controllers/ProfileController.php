<?php

namespace src\controllers;

use core\Controller;
use src\helpers\{
    UserHelper,
    MessageHelper,
    PostHelper
};

class ProfileController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHelper::checkLogin();
        
        if (!$this->loggedUser) {
            $this->redirect('/signin');
        }
    }

    public function index(array $data = [])
    {
        $id = $data['id'] ?? $this->loggedUser->getId();
        $page = intval(filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT));
        $feed = PostHelper::getUserFeed($id, $page, $this->loggedUser->getId());
        $user = UserHelper::idExists($id, true, true);
        $following = false;
        
        if (!$user) {
            $user = $this->loggedUser;
            $this->redirect('/profile');
        }

        if ($user->getId() !== $this->loggedUser->getId()) {
            $following = UserHelper::isFollowing($this->loggedUser->getId(), $user->getId());
        }

        $this->render('user/profile', [            
            'flash' => MessageHelper::catchMessage(),
            'user' => $this->loggedUser,
            'profile' => $user,
            'feed' => $feed,
            'following' => $following
        ]);
    }

    public function follow(array $data)
    {
        $id = intval($data['id']);

        if (UserHelper::idExists($id)) {
            if (UserHelper::isFollowing($this->loggedUser->getId(), $id)) {
                UserHelper::unfollow($this->loggedUser->getId(), $id);
            } else {
                UserHelper::follow($this->loggedUser->getId(), $id);
            }
        }

        $this->redirect('/profile/' . $id);
    }

    public function friends(array $data)
    {
        $id = $data['id'] ?? $this->loggedUser->getId();
        $page = intval(filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT));
        $user = UserHelper::idExists($id, true, true);
        $following = false;

        if (!$user) {
            $user = $this->loggedUser;
            $this->redirect('/profile/friends');
        }

        if ($user->getId() !== $this->loggedUser->getId()) {
            $following = UserHelper::isFollowing($this->loggedUser->getId(), $user->getId());
        }

        $this->render('user/friends', [            
            'flash' => MessageHelper::catchMessage(),
            'user' => $this->loggedUser,
            'profile' => $user,
            'following' => $following
        ]);
    }
}