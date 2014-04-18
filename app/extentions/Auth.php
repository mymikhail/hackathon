<?php

namespace Hackaton;

class Auth 
{
	const LOGIN = 'admin';
	const PASSWORD = 'admin';

	static public function auth($login, $password)
	{ 
		if ( $login && $password ) {
			return true;
		} else {
			return false;
		}	
	}
}