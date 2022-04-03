<?php

namespace Source\core\classes;

class DataUsers {

	public function userData() {

		if (isset($_SESSION['logged'])) {
			return $_SESSION['dataUser'];
		}
		return false;

	}

}