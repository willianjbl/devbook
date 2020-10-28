<?php

namespace src\helpers;

use src\models\{
    Post,
    Post_Comment,
    Post_Like,
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
        $picturesData = Post::select()->where('user_id', $userID)->where('type', 'picture')->get();
        $pictures = [];
        
        foreach ($picturesData as $picture) {
            $newPost = new Post();
            $newPost->setId($picture['id']);
            $newPost->setType($picture['type']);
            $newPost->setCreatedAt($picture['created_at']);
            $newPost->setBody($picture['body']);
            $newPost->isAuthor = false;
            
            if ((int)$picture['user_id'] === $userID) {
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

            $likes = Post_Like::select()->where('post_id', $post['id'])->get();
            $newPost->likesCount = count($likes);

            $commentList = Post_Comment::select()->where('post_id', $post['id'])->get();
            $comments = [];

            if (!empty($commentList)) {
                foreach ($commentList as $commentData) {
                    $userData = User::select()->where('id', $commentData['user_id'])->one();
                    $user = new User();
                    $user->setId($userData['id']);
                    $user->setName($userData['name']);
                    $user->setAvatar($userData['avatar']);

                    $comment = new Post_Comment();
                    $comment->setId($commentData['id']);
                    $comment->setPostId($commentData['post_id']);
                    $comment->setUserId($commentData['user_id']);
                    $comment->setBody($commentData['body']);
                    $comment->setCreatedAt($commentData['created_at']);
                    $comment->user = $user;

                    $comments[] = $comment;
                }
            }

            $newPost->comments = $comments;
            $newPost->liked = self::isLiked($post['id'], $loggedUser);
            
            $posts[] = $newPost;            
        }
        return $posts;
    }

    public static function addComment(int $postID, int $userID, string $body): void
    {
        Post_Comment::insert([
            'post_id' => $postID,
            'user_id' => $userID,
            'body' => $body,
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();
    }

    public static function isLiked(int $postID, int $userID): bool
    {
        $liked = Post_Like::select()->where('post_id', $postID)->where('user_id', $userID)->one();        
        return !empty($liked);
    }

    public static function addLike(int $postID, int $userID): void
    {
        Post_Like::insert([
            'post_id' => $postID,
            'user_id' => $userID,
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();
    }

    public static function removeLike(int $postID, int $userID): void
    {
        Post_Like::delete()->where('post_id', $postID)->where('user_id', $userID)->execute();
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

    public static function idExists(int $id): bool
    {
        $post = Post::select()->where('id', $id)->one();

        return !empty($post);
    }

    public static function isAuthor(int $id, int $user): bool
    {
        $post = Post::select()->where('id', $id)->where('user_id', $user)->one();

        return !empty($post);
    }

    public static function deletePost(int $id)
    {
        $post = Post::select()->where('id', $id)->one();
        $likes = Post_Like::select()->where('post_id', $post['id'])->get();
        $comments = Post_Comment::select()->where('post_id', $post['id'])->get();

        foreach ($likes as $like) {
            Post_Like::delete()->where('id', $like['id'])->execute();
        }
        foreach ($comments as $comment) {
            Post_Comment::delete()->where('id', $comment['id'])->execute();
        }

        if ($post['type'] === 'picture') {
            $file = IMAGE_POST . '/' . $post['body'];
            if (file_exists($file)) {
                unlink($file);
            }
        }

        Post::delete()->where('id', $id)->execute();
    }
}
