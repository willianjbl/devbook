<?php

namespace src\models;

use \core\Model;

class User extends Model {
    private int $id;
    private string $email;
    private string $name;
    private string $birthdate;
    private ?string $city;
    private ?string $work;
    private string $avatar;
    private string $cover;
    private string $token;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $value): void
    {
        $this->id = $value;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(?string $value): void
    {
        $this->email = $value;
    }

    public function getName(): string
    {
        $this->name = ucwords(mb_strtolower($this->name));
        return $this->name;
    }

    public function setName(?string $value): void
    {
        $this->name = $value;
    }

    public function getBirthDate(): string
    {
        return $this->birthdate;
    }

    public function setBirthDate(?string $value): void
    {
        $this->birthdate = $value;
    }

    public function getCity(): ?string
    {
        if (!empty($this->city)) {
            return $this->city;
        }
        return null;
    }

    public function setCity(?string $value): void
    {
        if (!empty($value)) {
            $this->city = $value;
        }
    }

    public function getWork(): ?string
    {
        if (!empty($this->work)) {
            return $this->work;
        }
        return null;
    }

    public function setWork(?string $value): void
    {
        if (!empty($value)) {
            $this->work = $value;
        }
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $value): void
    {
        $this->avatar = $value;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function setCover(?string $value): void
    {
        $this->cover = $value;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(?string $value): void
    {
        $this->token = $value;
    }
}
