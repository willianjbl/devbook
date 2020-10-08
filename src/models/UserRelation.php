<?php

namespace src\models;

use core\Model;

class UserRelation extends Model
{
    private $id;
    private $userFrom;
    private $userTo;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getUserFrom(): int
    {
        return $this->userFrom;
    }

    public function setUserFrom(int $value): void
    {
        $this->userFrom = $value;
    }

    public function getUserTo(): int
    {
        return $this->userTo;
    }

    public function setUserTo(int $value): void
    {
        $this->userTo = $value;
    }
}