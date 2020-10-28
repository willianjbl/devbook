<?php

namespace src\controllers;

use core\Controller;
use src\helpers\{
    UserHelper,
    MessageHelper,
    DateHelper,
    ImageHelper
};

class SettingsController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHelper::checkLogin();
        
        if (!$this->loggedUser) {
            $this->redirect('/signin');
        }
    }

    public function settings(): void
    {
        $this->render('tools/settings', [
            'user' => $this->loggedUser
        ]);
    }

    public function settingsAction(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) ?? null;
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING) ?? null;
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING) ?? null;
        $work = filter_input(INPUT_POST, 'work', FILTER_SANITIZE_STRING) ?? null;
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? null;
        $rePassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING) ?? null;
        $avatar = $_FILES['avatar'] ?? null;
        $cover = $_FILES['cover'] ?? null;

        // Checando se os dados do usuário vieram alterados
        if ($name && $email && $birthdate) {
            if (
                $name !== $this->loggedUser->getName() || $email !== $this->loggedUser->getEmail() ||
                $birthdate !== DateHelper::brazilianDateConvert($this->loggedUser->getBirthDate()) ||
                $city !== $this->loggedUser->getCity() || $work !== $this->loggedUser->getWork()
            ) {
                $user = UserHelper::emailExists($email, true);
                if (!empty($user) && $user['email'] !== $this->loggedUser->getEmail()) {
                    MessageHelper::flashMessage(MESSAGE_WARNING, 'E-mail já cadastrado!');
                } else {
                    $user = false;
                }
                if (!$user) {
                    $birthdate = DateHelper::americanDateConvert($birthdate);
                    if ($birthdate) {
                        UserHelper::updateUserInformation(
                            $this->loggedUser->getId(), $name, $email, $birthdate, $work, $city
                        );
                        MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados Alterados com sucesso!');
                    } else {
                        MessageHelper::flashMessage(MESSAGE_WARNING, 'Data inválida!');
                    }
                }
            }
        } else {
            MessageHelper::flashMessage(MESSAGE_ERROR, 'Campos obrigatórios devem ser preenchidos!');
        }

        // Checando se a senha do usuário veio alterada
        if ($password && $rePassword) {
            if ($password === $rePassword) {
                UserHelper::updateUserPassword($this->loggedUser->getId(), $password);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados Alterados com sucesso!');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'As senhas não coincidem!');
            }
        }

        // Checando avatar
        if ($avatar && !empty($avatar['tmp_name'])) {
            if (in_array($avatar['type'], ['image/jpg', 'image/jpeg', 'image/png', 'image/bmp'])) {
                $filename = ImageHelper::extractImage($avatar, 200, 200, IMAGE_AVATAR);
                UserHelper::updateUserImage($this->loggedUser->getId(), $filename, 'avatar', IMAGE_AVATAR);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados alterados com sucesso!');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'Arquivo não suportado!');
            }
        }

        // Checando cover
        if ($cover && !empty($cover['tmp_name'])) {
            if (in_array($cover['type'], ['image/jpg', 'image/jpeg', 'image/png', 'image/bmp'])) {
                $filename = ImageHelper::extractImage($cover, 838, 250, IMAGE_COVER);
                UserHelper::updateUserImage($this->loggedUser->getId(), $filename, 'cover', IMAGE_COVER);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados alterados com sucesso!');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'Arquivo não suportado!');
            }
        }

        $this->redirect('/settings');
    }
}
