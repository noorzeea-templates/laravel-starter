<?php
	
	
	namespace App\Services;
	
	use App\Models\User;
	use App\Traits\NameBuilder;
	use App\Traits\ApiResponser;
	
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	
	
	class UserService
	{
		use NameBuilder;
		use ApiResponser;
		
		public function getUser($user_id)
		{
			return User::findOrFail($user_id);
		}
		
		public function createUser($user_data)
		{
			info("Creating user");
			
			$user = User::create([
				'name' => $user_data['name'],
				'password' => bcrypt($user_data['password']),
				'email' => $user_data['email']
			]);
			
			info("User created", ['password' => $user->password]);
			
			return $user->id;
		}
		
		public function userLogin($credentials)
		{
			info("TRYING LOGIN", ["cred" => $credentials]);
			
			if (!Auth::attempt($credentials)) {
				return $this->error('There was an error during the authentication process', 401);
				
			}
			
			// CREATE TOKEN
			$user_token = auth()->user()->createToken('API Token')->plainTextToken;
			
			return $this->success("Sign in successful",200, $user_token );
//			return $user_token;
		}
		
	}

