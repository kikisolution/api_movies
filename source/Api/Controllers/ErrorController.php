<?php

namespace Source\Api\Controllers;

class ErrorController
{

    public function __construct()
    {
    }

    public function error(array $data): void
    {
        $arrResponse = [
            "status" => "error",
            "message" => "Recurso não encontrado",
        ];

        toJson($arrResponse);
    }
}