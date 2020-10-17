<?php

namespace src\models;

use core\Model;

class Post_Comment extends Model
{
    private $id;
    private $postId;
    private $userId;
    private $body;
    private $createdAt;

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

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $value): void
    {
        $this->body = $value;
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
