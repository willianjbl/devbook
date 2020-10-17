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

    public function addComment(array $data)
    {
        $retorno = ['error' => true, 'message' => 'Erro ao adicionar mensagem'];

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;
        $txt = filter_input(INPUT_POST, 'txt', FILTER_SANITIZE_STRING) ?? null;

        if ($id && $txt) {
            PostHelper::addComment($id, $this->loggedUser->getId(), $txt);
            $retorno = [
                'error' => false,
                'message' => 'Comentário adicionado.',
                'data' => [
                    'link' => "/profile/{$this->loggedUser->getId()}",
                    'avatar' => "/media/avatars/{$this->loggedUser->getAvatar()}",
                    'name' => $this->loggedUser->getName(),
                    'body' => $txt,
                ]
            ];
        }

        header('Content-type: application/json');
        echo json_encode($retorno);
        exit;
    }
}
