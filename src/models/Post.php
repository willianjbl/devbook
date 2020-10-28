<?php

namespace src\models;

use core\Model;

class Post extends Model
{
    private int $id;
    private int $userId;
    private string $type;
    private string $createdAt;
    private string $body;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): void
    {
        $this->userId = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $value): void
    {
        $this->type = $value;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $value): void
    {
        $this->createdAt = $value;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $value): void
    {
        $this->body = $value;
    }
}
