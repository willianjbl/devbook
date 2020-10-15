<?php

namespace src\controllers;

use core\Controller;
use src\helpers\{
    UserHelper,
    MessageHelper,
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
        $search = filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);

        if (empty($search)) {
            $this->redirect('/');
        }

        $this->render('tools/search', [
            'user' => $this->loggedUser,
        ]);
    }
}
