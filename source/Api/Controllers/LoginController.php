<?php

namespace Source\Api\Controllers;

use Source\Api\Controllers\UserController;

class LoginController
{
    /** @var UserController $userController */
    protected $userController;

    public function __construct(object $routes = null, UserController $userController = null)
    {
        $this->userController = (!$userController) ? new UserController() : $userController;
    }

    /**
     * @param array $data
     */
    public function loginInit(array $data): void
    {
       if($this->userController->checkEmail($data) && $this->userController->checkPassword($data)){
            $this->success($this->userController->getUser());
       }else{
            $this->fail();
       }
    }

    /**
     * @return void
     */
    private function fail(): void
    {
        $arrResponse = [
            "status" => "error",
            "message" => "Usuário ou senha inválidos!",
        ];
        $this->printResponse($arrResponse);
    }

    /**
     * @param $data
     */
    private function success($data): void
    {
        //Generates Token JWT code
        $newTokenJWT = AuthController::generateToken($data);
        unset($data->id, $data->password);

        $arrResponse = [
            "status" => "success",
            "message" => "Login Autorizado!",
            "_tokenJWT" => $newTokenJWT,
            "_dataUser" => json_encode($data),
        ];
        $this->printResponse($arrResponse);

    }

    /**
     * @param array $data
     */
    private function printResponse(array $data): void
    {
        $jsonResponse = json_encode($data);
        echo $jsonResponse;
    }

}