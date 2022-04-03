<?php

namespace Source\core\classes;

class Password {

	public static function createHash($password) {
		$options = [
			'cost' => 12,
		];

		return password_hash($password, PASSWORD_DEFAULT, $options);
	}

	public static function verify($password, $hash) {
		return password_verify($password, $hash);
	}

}