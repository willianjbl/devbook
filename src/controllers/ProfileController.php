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
        $feed = PostHelper::getHomeFeed($this->loggedUser->getId(), $page);
        $user = UserHelper::idExists($id, true);
        
        if (!$user) {
            $user = $this->loggedUser;
        }

        $this->render('user/profile', [            
            'flash' => MessageHelper::catchMessage(),
            'user' => $this->loggedUser,
            'profile' => $user,
            'feed' => $feed,
        ]);
    }
}