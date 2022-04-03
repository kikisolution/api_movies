<?php

/**
 * API - PHP Api management favorites movies
 * NOTE: Requires PHP version 7 or later
 *
 * @category  PHP
 * @package   API_Desafio
 * @author    Ezequias Fonseca <ezequiasfonseca@gmail.com>
 * @copyright 2022 - 2022 Ezequias Fonseca
 * @license   The MIT License (MIT)
 * @version   "GIT: 1.0"
 * @link      https://focointenso.com.br
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding');
header('Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE');

// Composer autoLoad.
require __DIR__.'/vendor/autoload.php';

// Routes.
require __DIR__.'/source/Router.php';
