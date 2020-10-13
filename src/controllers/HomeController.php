<?php

namespace src\controllers;

use \core\Controller;
use src\helpers\{
    UserHelper,
    MessageHelper,
    PostHelper
};

class HomeController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHelper::checkLogin();
        
        if (!$this->loggedUser) {
            $this->redirect('/signin');
        }
    }

    public function index()
    {
        $page = intval(filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT));
        $feed = PostHelper::getHomeFeed($this->loggedUser->getId(), $page);

        $this->render('user/feed', [
            'flash' => MessageHelper::catchMessage(),
            'user' => $this->loggedUser,
            'feed' => $feed,
        ]);
    }
}
