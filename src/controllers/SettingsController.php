<?php

namespace src\controllers;

use core\Controller;
use src\helpers\{
    UserHelper,
    MessageHelper,
    DateHelper
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
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $work = filter_input(INPUT_POST, 'work', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $rePassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);

        if ($name && $email && $birthdate) {
            if (
                $name !== $this->loggedUser->getName() || $email !== $this->loggedUser->getEmail() ||
                $birthdate !== DateHelper::brazilianDateConvert($this->loggedUser->getBirthDate()) ||
                $city !== $this->loggedUser->getCity() || $work !== $this->loggedUser->getWork()
            ) {
                $user = UserHelper::emailExists($email, true);
                if (!empty($user)) {
                    if ($user['email'] === $this->loggedUser->getEmail()) {
                        $user = false;
                    } else {
                        MessageHelper::flashMessage(MESSAGE_WARNING, 'E-mail já cadastrado!');
                        $this->redirect('/settings');
                    }
                }
                if (!$user) {
                    $birthdate = DateHelper::americanDateConvert($birthdate);
                    if ($birthdate) {
                        UserHelper::updateUserInformation(
                            $this->loggedUser->getId(), $name, $email, $birthdate, $work, $city
                        );
                        MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados Alterados com sucesso!');
                        $this->redirect('/settings');
                    } else {
                        MessageHelper::flashMessage(MESSAGE_ERROR, 'Data inválida!');
                        $this->redirect('/settings');
                    }
                }
            }
        }

        if ($password && $rePassword) {
            if ($password === $rePassword) {
                UserHelper::updateUserPassword($this->loggedUser->getId(), $password);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados Alterados com sucesso!');
                $this->redirect('/settings');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'As senhas não coincidem!');
                $this->redirect('/settings');
            }
        }
        $this->redirect('/settings');
    }
}