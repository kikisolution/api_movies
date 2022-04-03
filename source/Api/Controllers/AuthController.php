<?php
namespace Source\Api\Controllers;
    
class AuthController
{

    private static $key = API_KEY; //Application Key

    public static function generateToken(object $data): string
    {
        //Header Token
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        //Payload - Content
        $payload = [
            'name' => $data->first_name,
            'email' => $data->email,
        ];

        //JSON
        $header = json_encode($header);
        $payload = json_encode($payload);

        //Base 64
        $header = self::base64UrlEncode($header);
        $payload = self::base64UrlEncode($payload);

        //Sign
        $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
        $sign = self::base64UrlEncode($sign);

        //Token
        $token = $header . '.' . $payload . '.' . $sign;

        return $token;

    }

    public static function checkAuth(): bool
    {
        $http_header = apache_request_headers();

        if (isset($http_header['Authorization']) && $http_header['Authorization'] !== null) {

            $bearer = explode(' ', $http_header['Authorization']);

            $token = explode('.', $bearer[1]);
            $header = $token[0];
            $payload = $token[1];
            $sign = $token[2];

            //Conferir Assinatura
            $valid = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
            $valid = self::base64UrlEncode($valid);

            if ($sign === $valid) {
                return true;
            }
        }

        return false;
    }

    private static function base64UrlEncode($data)
    {
        $b64 = base64_encode($data);

        if ($b64 === false) {
            return false;
        }

        $url = strtr($b64, '+/', '-_');

        return rtrim($url, '=');
    }

}
