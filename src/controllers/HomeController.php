<?php
namespace src\controllers;

use \core\Controller;
use src\helpers\{
    LoginHelper,
    MessageHelper
};

class HomeController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = LoginHelper::checkLogin();
        
        if (!$this->loggedUser) {
            $this->redirect('/signin');
        }
    }

    public function index()
    {
        $flash = MessageHelper::catchMessage();        
        $this->render('user/feed', ['flash' => $flash]);
    }
}
