<?php

namespace Source\Api\Controllers;

use Source\Api\Models\User;
use Source\core\classes\Password;

class LoginControllerBkp
{

    public function __construct()
    {
    }

    /**
     * @param $data
     * @return string
     */
    public function loginAuthorization(array $data): string
    {

        //Check Autentication
        if($user = (new User())->find("email = :email", "email={$data['email']}")->fetch()){

            if (Password::verify($data['password'], $user->password)) {

                //Generates Token JWT code
                $newTokenJWT = AuthController::generateToken($user->data());

                unset($user->data()->password);
                unset($user->data()->id);

                $arrResponse = [
                    "status" => "success",
                    "message" => "Login Autorizado!",
                    "_tokenJWT" => $newTokenJWT,
                    "_dataUser" => json_encode($user->data()),
                ];

                return $this->returnResponse($arrResponse);

            }else{

                $arrResponse = [
                    "status" => "error",
                    "message" => "Usuário ou senha inválidos!",
                ];
                return $this->returnResponse($arrResponse);

            }

        }else{

            $arrResponse = [
                "status" => "error",
                "message" => "Usuário ou senha inválidos!",
            ];
            return $this->returnResponse($arrResponse);

        }

    }

    /**
     * @param array $data
     * @return string
     */
    private function returnResponse(array $data): string
    {
        $jsonResponse = json_encode($data);
        echo $jsonResponse;
        return $jsonResponse;
    }

}