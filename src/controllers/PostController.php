<?php

namespace src\controllers;

use core\Controller;
use src\helpers\UserHelper;
use src\helpers\PostHelper;

class PostController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHelper::checkLogin();
        
        if (!$this->loggedUser) {
            $this->redirect('/signin');
        }
    }

    public function new()
    {
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
        
        if ($body) {
            PostHelper::addPost($this->loggedUser->getId(), 'text', $body);
        }
        $this->redirect('/');
    }
}
