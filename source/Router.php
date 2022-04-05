<?php

use CoffeeCode\Router\Router;

$router = new Router(API_URL);

/*
 * Routers Api
 */

$router->group("api")->namespace("Source\Api\Controllers");
$router->post("/create-user", "UserController:createUser");
$router->post("/auth/login", "LoginController:loginInit");

$router->get("/favorits/list/{hashUser}", "FavoritController:list");
$router->delete("/favorits/delete/{id}", "FavoritController:delete");
$router->post("/favorits/add", "FavoritController:add");

/*
 * ERROS
 */
$router->get("/ooops/{errcode}", "ErrorController:error");

/*
 * PROCESS
 */
$router->dispatch();
if($router->error()){
    $router->redirect("/ooops/{$router->error()}");
}