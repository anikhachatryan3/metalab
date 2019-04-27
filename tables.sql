CREATE DATABASE IF NOT EXISTS meatlabs;
ALTER TABLE meatlabs
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_unicode_ci;

/*creating user table*/
DROP TABLE IF EXISTS `meatlabs`.`users`;
CREATE TABLE `meatlabs`.`users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `first` varchar(256) NOT NULL,
    `last` varchar(256) NOT NULL,
    `email` varchar(256) NOT NULL,
    `password` varchar(256) NOT NULL,
    `username` varchar(256) NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE(`email`),
    UNIQUE(`username`)
);

DROP TABLE IF EXISTS `meatlabs`.`posts`;
CREATE TABLE `meatlabs`.`posts` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
    `title` varchar(256) NOT NULL,
    `body` text NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_User_Posts FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
