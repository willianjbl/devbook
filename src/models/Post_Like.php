<?php

namespace src\models;

use core\Model;

class Post_Like extends Model
{
    private int $id;
    private int $postId;
    private int $userId;
    private string $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $value): void
    {
        $this->postId = $value;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): void
    {
        $this->userId = $value;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $value): void
    {
        $this->createdAt = $value;
    }
}
