CREATE SCHEMA `devbook`;

use `devbook`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(200) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `birthdate` DATE NOT NULL,
    `city` VARCHAR(100) NULL,
    `work` VARCHAR(100) NULL,
    `avatar` VARCHAR(255) NOT NULL DEFAULT 'avatar.jpg',
    `cover` VARCHAR(255) NOT NULL DEFAULT 'cover.jpg',
    `token` VARCHAR(200) NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `user_relations`;

CREATE TABLE `user_relations` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_from` INT(11) UNSIGNED NOT NULL,
    `user_to` INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_from`) REFERENCES `users`(`id`),
    FOREIGN KEY (`user_to`) REFERENCES `users`(`id`)
);

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(20) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `body` TEXT NOT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `post_comments`;

CREATE TABLE `post_comments` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `post_id` INT(11) UNSIGNED NOT NULL,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `body` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

DROP TABLE IF EXISTS `post_likes`;

CREATE TABLE `post_likes` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `post_id` INT(11) UNSIGNED NOT NULL,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
