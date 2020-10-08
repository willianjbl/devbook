<?php

namespace src\controllers;

use core\Controller;
use src\helpers\{
    LoginHelper,
    MessageHelper,
    PostHelper
};

class ProfileController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = LoginHelper::checkLogin();
        
        if (!$this->loggedUser) {
            $this->redirect('/signin');
        }
    }

    public function index(array $data = [])
    {
        $id = $data['id'] ?? $this->loggedUser->getId();        
        $user = LoginHelper::idExists($id, true);
        
        $page = intval(filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT));
        $feed = PostHelper::getHomeFeed($this->loggedUser->getId(), $page);

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