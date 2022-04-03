<?php

//Api key
define('API_URL', "http://localhost:9000/api");
define("API_KEY", "d41d8cd98f00b204e9800998ecf8427e");

##DB - CONNECTION
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "api-mysql",
    "port" => "3306",
    "dbname" => "desafio",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

##DB - CONNECTION
define("DATA_LAYER_CONFIG_2", [
    "driver" => "mysql",
    "host" => "api-mysql",
    "port" => "3306",
    "dbname" => "desafio",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
