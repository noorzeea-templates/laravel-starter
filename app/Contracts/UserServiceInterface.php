<?php
// app/Library/Services/Contracts/AuthenticationServiceInterface.php
	namespace App\Contracts;
	
	Interface UserServiceInterface
	{
		public function login(array $credentials);
		public function logout(array $credentials);
	}