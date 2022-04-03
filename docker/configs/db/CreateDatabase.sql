CREATE DATABASE IF NOT EXISTS desafio;
USE desafio;

SET character_set_client = utf8;
SET character_set_connection = utf8;
SET character_set_results = utf8;
SET collation_connection = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `desafio`.`favorits_movies` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_movie` INT NOT NULL,
    `user_hash` varchar(255) NOT NULL,
    `title` varchar(100) NOT NULL,
    `adult` varchar(6) DEFAULT NULL,
    `poster_path` varchar(45) DEFAULT NULL,
    `backdrop_path` varchar(45) DEFAULT NULL,
    `original_language` varchar(6) DEFAULT NULL,
    `original_title` varchar(100) DEFAULT NULL,
    `overview` varchar(255) DEFAULT NULL,
    `popularity` char(5) DEFAULT NULL,
    `release_date` date DEFAULT NULL,
    `video` varchar(45) DEFAULT NULL,
    `vote_average` char(5) DEFAULT NULL,
    `vote_count` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `desafio`.`users` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `first_name` VARCHAR(255) NOT NULL,
   `last_name` VARCHAR(255) NOT NULL,
   `email` VARCHAR(255) NOT NULL,
   `password` VARCHAR(255) NOT NULL,
   `hash` VARCHAR(255) NULL,
   `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_at` TIMESTAMP NULL DEFAULT NULL,
   PRIMARY KEY (`id`),
   UNIQUE INDEX `email_UNIQUE` (`email` ASC)
);

