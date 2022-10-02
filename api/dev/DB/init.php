<?php

$query = 
'CREATE TABLE `language` (
    `id` int AUTOINCREMENT,
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
  
  CREATE TABLE `user` (
    `id` int,
    `username` varchar(255) UNIQUE,
    `password` varchar(255),
    `email` varchar(255),
    `phone` int,
    `first_name` varchar(255),
    `last_name` varchar(255),
    `registration_date` date,
    `access_level` int,
    `birth_date` date,
    `age` int,
    `class_id` int,
    `function_id` int,
    `language_id` int,
    PRIMARY KEY (`id`)
  );
  
  CREATE TABLE `function` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  
  ';
