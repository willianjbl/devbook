<?php

namespace src\controllers;

use core\Controller;
use src\helpers\{
    UserHelper,
    PostHelper
};

class AjaxController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHelper::checkLogin();
        
        if (!$this->loggedUser) {
            header('Content-type: application/json');
            echo json_encode([
                'error' => true,
                'message' => 'Usuário não está logado!'
            ]);
            exit;
        }
    }

    public function like(array $data)
    {
        $id = $data['id'];

        if (PostHelper::isLiked($id, $this->loggedUser->getId())) {
            PostHelper::removeLike($id, $this->loggedUser->getId());
        } else {
            PostHelper::addLike($id, $this->loggedUser->getId());
        }
    }
}
