<?php

namespace src\helpers;

use src\models\{
    Post,
    User,
    UserRelation
};

class PostHelper
{
    public static function addPost(int $id, string $type, string $body): void
    {
        $body = trim($body);
        
        if ($body) {
            Post::insert([
                'user_id' => $id,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'body' => $body
            ])->execute();
        }
    }

    public static function getHomeFeed(int $userId, int $page): array
    {
        $page = ($page <= 0)? 1 : $page;
        $perPage = 2;

        $userList = UserRelation::select()->where('user_from', $userId)->get();
        $users = [];

        foreach ($userList as $user) {
            $users[] = $user['user_to'];
        }
        $users[] = $userId;

        $postList = Post::select()
            ->where('user_id', 'in', $users)
            ->orderBy('created_at', 'desc')
            ->page($page - 1, $perPage)
            ->get();

        $postCount = Post::select()
            ->where('user_id', 'in', $users)
            ->count();
        $totalPages = ceil($postCount / $perPage);
        
        $posts = [];
        foreach ($postList as $post) {
            $newPost = new Post();
            $newPost->setId($post['id']);
            $newPost->setUserId($post['user_id']);
            $newPost->setType($post['type']);
            $newPost->setCreatedAt($post['created_at']);
            $newPost->setBody($post['body']);
            $newPost->isAuthor = false;
            
            if ((int)$post['user_id'] === $userId) {
                $newPost->isAuthor = true;
            }
            
            $newUser = User::select()->where('id', $post['user_id'])->one();
            $user = new User();
            $user->setId($newUser['id']);
            $user->setName($newUser['name']);
            $user->setAvatar($newUser['avatar']);
            $newPost->user = $user;
            
            $newPost->likesCount = 0;
            $newPost->comments = [];
            $newPost->liked = false;
            
            $posts[] = $newPost;
        }

        return [
            'posts' => $posts,
            'pageCount' => $totalPages,
            'currentPage' => $page,
        ];
    }
}