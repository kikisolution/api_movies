<?php

namespace Source\core\classes;

class Redirect {

	public static function redirect($target) {
		return header("Location:{$target}");
	}

	public static function back()
    {

		$previous = "javascript:history.go(-1)";

		if (isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
		}

		return header("Location:{$previous}");
	}

    public static function http_referer($param = null)
    {

        $cookieHttpReferer = $_SERVER['REQUEST_URI'];
        setcookie('_authUserHttpReferer', $cookieHttpReferer, (time() + (1 * 24 * 3600)), $_SERVER['SERVER_NAME']);

    }

}