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
                $path = 'media/avatars';
                $filename = $this->extractImage($avatar, 200, 200, $path);
                UserHelper::updateUserImage($this->loggedUser->getId(), $filename, 'avatar', $path);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados alterados com sucesso!');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'Arquivo não suportado!');
            }
        }

        // Checando cover
        if ($cover && !empty($cover['tmp_name'])) {
            if (in_array($cover['type'], ['image/jpg', 'image/jpeg', 'image/png', 'image/bmp'])) {
                $path = 'media/covers';
                $filename = $this->extractImage($cover, 838, 250, $path);
                UserHelper::updateUserImage($this->loggedUser->getId(), $filename, 'cover', $path);
                MessageHelper::flashMessage(MESSAGE_SUCCESS, 'Dados alterados com sucesso!');
            } else {
                MessageHelper::flashMessage(MESSAGE_ERROR, 'Arquivo não suportado!');
            }
        }

        $this->redirect('/settings');
    }

    public function extractImage(array $file, int $width, int $height, string $path): string
    {
        $filename = $file['name'];
        list($sourceWidth, $sourceHeight) = getimagesize($file['tmp_name']);
        $ratio = $sourceWidth / $sourceHeight;
        $newWidth = $width;
        $newHeight = $newWidth / $ratio;

        if ($newHeight < $height) {
            $newHeight = $height;
            $newWidth = $newHeight * $ratio;
        }

        $x = $width - $newWidth;
        $y = $height - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;

        $finalImage = imagecreatetruecolor($width, $height);
        switch ($file['type']) {
            case 'image/jpg':
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
            case 'image/bmp':
                $image = imagecreatefrombmp($file['tmp_name']);
                break;
        }

        imagecopyresampled(
            $finalImage, $image, $x, $y, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight
        );

        $filename = md5($filename . time() . rand(0, 99999)) . '.jpg';
        imagejpeg($finalImage, $path . '/' . $filename);
        imagedestroy($finalImage);

        return $filename;
    }
}
