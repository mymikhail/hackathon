<?php

namespace Hackaton;

class Auth 
{
	const LOGIN = 'admin';
	const PASSWORD = 'admin';

	static public function login($login, $password)
	{ 
		if ( $login == self::LOGIN && $password == self::PASSWORD) {
			$_SESSION['user'] = md5($login.$password);
			return true;
		} else {
			return false;
		}	
	}

	static public function auth()
	{ 
		if (isset($_SESSION['user']) && $_SESSION['user']) {
			return true;
		} else {
			return false;
		}	
	}

	static public function logout()
	{ 
		if (isset($_SESSION['user']) && $_SESSION['user']) {
			unset($_SESSION['user']);
		}
	}
}