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
            $retorno['message'] = 'Usuário não está logado!';
            $this->returnJson($retorno);
        }
    }

    public function like(array $data): void
    {
        $id = $data['id'];

        if (PostHelper::isLiked($id, $this->loggedUser->getId())) {
            PostHelper::removeLike($id, $this->loggedUser->getId());
        } else {
            PostHelper::addLike($id, $this->loggedUser->getId());
        }
    }

    public function addComment(array $data): void
    {
        $retorno['message'] = 'Erro ao adicionar comentário!';

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
        $this->returnJson($retorno);
    }

    private function returnJson(array $retorno = []): void
    {
        if (empty($retorno)) {
            $retorno = ['error' => true, 'message' => 'Erro ao executar esta requisição.'];
        }

        header('Content-type: application/json');
        echo json_encode($retorno);
        exit;
    }
}
