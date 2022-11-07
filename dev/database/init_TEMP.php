<?php

$exemple = 'CREATE TABLE `language` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  
  CREATE TABLE `class` (
    `id` int,
    `name` char(64),
    `master_id` int,
    PRIMARY KEY (`id`)
  );
  
  CREATE TABLE `access_level` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  CREATE TABLE `tokens` (
    `user_id` int,
    `issue_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `token` varchar(255),
    PRIMARY KEY (`user_id`)
  );
  
  CREATE TABLE `user` (
    `id` int NOT NULL PRIMARY KEY,
    `username` varchar(255) UNIQUE NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) UNIQUE NOT NULL,
    `phone` int,
    `first_name` varchar(255),
    `last_name` varchar(255),
    `registration_date` date DEFAULT CURRENT_TIMESTAMP,
    `access_level` int DEFAULT 10,
    `birth_date` date,
    `age` int DEFAULT 0,
    `class_id` int DEFAULT NULL,
    `function_id` int DEFAULT NULL,
    `language_id` int DEFAULT 1
  );
  CREATE TABLE `function` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  ALTER TABLE `user` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT; 
  ALTER TABLE `class` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT; 
  ALTER TABLE `language` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT;
  ALTER TABLE `function` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT;
  ALTER TABLE `access_level` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT;
ALTER TABLE `class`
    ADD CONSTRAINT `master_id`
    FOREIGN KEY (`master_id`)
    REFERENCES `user`(`id`);
  
ALTER TABLE `user`
    ADD CONSTRAINT `language_id`
    FOREIGN KEY (`language_id`)
    REFERENCES `language`(`id`);
  
ALTER TABLE `user`
    ADD CONSTRAINT `class_id`
    FOREIGN KEY (`class_id`)
    REFERENCES `class`(`id`);
ALTER TABLE `user`
    ADD CONSTRAINT `access_level`
    FOREIGN KEY (`access_level`)
    REFERENCES `access_level`(`id`);
ALTER TABLE `tokens`
    ADD CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user`(`id`);
SET foreign_key_checks = 0;
 INSERT INTO language(`id`, `name`) VALUES'." (1, 'ROMANA');".
'INSERT INTO `user`(`username`, `password`, `email`, `phone`, `first_name`, `last_name`, `access_level`, `birth_date`, `age`, `class_id`, `function_id`, `language_id`) VALUES '."('anghelmarian05', '1234', 'mariananghel99@gmail.com', 0769698932, 'Marian', 'Anghel', 0, '1999-01-05', 23, NULL, 1, 1);".
'INSERT INTO `access_level`(`id`, `name`) VALUES ' . "(1,'Administrator');".
'INSERT INTO `function`(`id`, `name`) VALUES ' . "(1,'Analist Programator');".
'SET foreign_key_checks = 1;
  ';