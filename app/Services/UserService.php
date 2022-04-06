<?php
	
	
	namespace App\Services;
	
	use App\Contracts\ApiInterface;
	use App\Contracts\UserServiceInterface;
	use App\Models\User;
	use App\Traits\NameBuilder;
	use App\Traits\ApiResponser;
	
	use Illuminate\Support\Facades\Auth;
	
	
	class UserService implements ApiInterface, UserServiceInterface
	{
		use NameBuilder;
		use ApiResponser;
		
		public function getOne($user_id)
		{
			return User::findOrFail($user_id);
		}
		
		public function create($user_data)
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
		
		public function login($credentials)
		{
			info("TRYING LOGIN", ["cred" => $credentials]);
			
			if (!Auth::attempt($credentials))
				return $this->error('There was an error during the authentication process', 401);
			
			// CREATE TOKEN
			$user_token = auth()->user()->createToken('API Token')->plainTextToken;
			
			return $this->success("Sign in successful",200, $user_token );
//			return $user_token;
		}
		
		public function getAll()
		{
			// TODO: Implement getAll() method.
		}
		
		public function update(string $entity_id, array $data)
		{
			// TODO: Implement update() method.
		}
		
		public function delete(string $entity_id)
		{
			// TODO: Implement delete() method.
		}
		
		public function logout(array $credentials)
		{
			// TODO: Implement logout() method.
		}
	}

