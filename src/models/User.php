<?php
namespace src\models;
use \core\Model;

class User extends Model {
    private $id;
    private $email;
    private $name;
    private $birthdate;
    private $city;
    private $work;
    private $avatar;
    private $cover;
    private $token;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(int $value): void
    {
        $this->email = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(int $value): void
    {
        $this->name = $value;
    }

    public function getBirthDate(): string
    {
        return $this->birthdate;
    }

    public function setBirthDate(int $value): void
    {
        $this->birthdate = $value;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(int $value): void
    {
        $this->city = $value;
    }

    public function getWork(): string
    {
        return $this->work;
    }

    public function setWork(int $value): void
    {
        $this->work = $value;
    }

    public function getAvatar(): int
    {
        return $this->avatar;
    }

    public function setAvatar(int $value): void
    {
        $this->avatar = $value;
    }

    public function getCover(): int
    {
        return $this->cover;
    }

    public function setCover(int $value): void
    {
        $this->cover = $value;
    }

    public function getToken(): int
    {
        return $this->token;
    }

    public function setToken(int $value): void
    {
        $this->token = $value;
    }
}
