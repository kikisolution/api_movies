<?php

namespace Source\Api\Controllers;

use Source\Api\Models\User;
use Source\Api\Controllers\AuthController;
use Source\core\classes\Password;
class UserController
{

    protected $user;

    public function __construct()
    {
    }

    public function createUser(array $data): void
    {

        //Check if email exists
        if($this->checkEmail($data)){

            $arrResponse = [
                "status" => "error",
                "message" => "E-mail já cadastrado, tente outro...",
            ];

            toJson($arrResponse);

        }

        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Password::createHash($data['password']);
        $user->hash = base64url_encode($data['email']);
        $user->save();

        if($user->fail()){

            $arrResponse = [
                "status" => "error",
                "message" => "Ooops, algo deu errado, tente novamente mais tarde. <br> Erro: s{$user->fail()->getMessage()}",
            ];

        }else{

            $arrResponse = [
                "status" => "success",
                "message" => "Cadastro Realizado Com Sucesso.",
            ];

        }

        toJson($arrResponse);

    }

    /**
     * @param array $data
     * @return bool
     */
    public function checkEmail(array $data): bool
    {
        if($this->user = (new User)->find("email = :email", "email={$data['email']}")->fetch()){
            return true;
        }
        return false;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function checkPassword(array $data): bool
    {
        if (Password::verify($data['password'], $this->user->password)) {
            return true;
        }
        return false;
    }

    /**
     * @return object
     */
    public function getUser(): object
    {
       return $this->user->data();
    }

}