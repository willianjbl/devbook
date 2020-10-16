<?php

namespace src\helpers;

use src\models\{
    Post,
    User,
    User_Relation
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

    public static function getPicturesFrom(int $userID): array
    {
        $picturesData = Post::select()->where('id', $userID)->where('type', 'picture')->get();
        $pictures = [];
        
        foreach ($picturesData as $picture) {
            $newPost = new Post();
            $newPost->setId($picturesData['id']);
            $newPost->setType($picturesData['type']);
            $newPost->setCreatedAt($picturesData['created_at']);
            $newPost->setBody($picturesData['body']);
            $newPost->isAuthor = false;
            
            if ((int)$picturesData['user_id'] === $userID) {
                $newPost->isAuthor = true;
            }

            $pictures[] = $newPost;
        }
        return $pictures;
    }

    private static function getPosts(array $postList, int $loggedUser): array
    {
        $posts = [];
        foreach ($postList as $post) {
            $newPost = new Post();
            $newPost->setId($post['id']);
            $newPost->setUserId($post['user_id']);
            $newPost->setType($post['type']);
            $newPost->setCreatedAt($post['created_at']);
            $newPost->setBody($post['body']);
            $newPost->isAuthor = false;
            
            if ((int)$post['user_id'] === $loggedUser) {
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
        return $posts;
    }

    public static function getUserFeed(int $userID, int $page, int $loggedUser): array
    {
        $page = ($page <= 0)? 1 : $page;
        $perPage = 4;

        $postList = Post::select()
            ->where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->page($page - 1, $perPage)
            ->get();

        $postCount = Post::select()
            ->where('user_id', $userID)
            ->count();
        $totalPages = ceil($postCount / $perPage);

        $posts = self::getPosts($postList, $loggedUser);            

        return [
            'posts' => $posts,
            'pageCount' => $totalPages,
            'currentPage' => $page,
        ];
    }

    public static function getHomeFeed(int $userID, int $page): array
    {
        $page = ($page <= 0)? 1 : $page;
        $perPage = 4;

        $userList = User_Relation::select()->where('user_from', $userID)->get();
        $users = [];

        foreach ($userList as $user) {
            $users[] = $user['user_to'];
        }
        $users[] = $userID;

        $postList = Post::select()
            ->where('user_id', 'in', $users)
            ->orderBy('created_at', 'desc')
            ->page($page - 1, $perPage)
            ->get();

        $postCount = Post::select()
            ->where('user_id', 'in', $users)
            ->count();
        $totalPages = ceil($postCount / $perPage);
        
        $posts = self::getPosts($postList, $userID);

        return [
            'posts' => $posts,
            'pageCount' => $totalPages,
            'currentPage' => $page,
        ];
    }
}
