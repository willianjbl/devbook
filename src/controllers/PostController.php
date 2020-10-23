<?php

namespace src\controllers;

use core\Controller;
use src\helpers\MessageHelper;
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

    public function new(): void
    {
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
        
        if ($body) {
            PostHelper::addPost($this->loggedUser->getId(), 'text', $body);
        }
        $this->redirect('/');
    }

    public function delete(array $data): void
    {
        $id = $data['id'];

        if (!empty($id) || !PostHelper::idExists($id)) {
            if (PostHelper::isAuthor($id, $this->loggedUser->getId())) {
                PostHelper::deletePost($id);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Post Excluído!');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'Este post não é seu!');
            }
        } else {
            MessageHelper::flashMessage(MESSAGE_ERROR, 'Post não encontrado!');
        }
        $this->redirect('/');
    }
}
