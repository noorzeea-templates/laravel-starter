<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\User;
	use App\Services\UserService;
	use App\Traits\ApiResponser;
	use Illuminate\Http\Request;
	
	
	class AuthenticationController extends Controller
	{
		use ApiResponser;
		
		protected $userService;
		
		public function __construct()
		{
			$this->userService = app(UserService::class);
		}
		
		//      LOGOUT USER BY DELETING TOKEN
		public function logout()
		{
			return auth()->user()->tokens()->delete();
		}
		
//    CREATE A NEW USER
		public function register(Request $request)
		{
			try {
				info('Registering new user');
				
				$user_data = $request->validate([
					'name' => 'required|string|max:255',
					'email' => 'required|string|email|unique:users,email',
					'password' => 'required|string|min:6|confirmed'
				]);
				
				
				info('Data validated');
				
				$user_id = $this->userService->createUser($user_data);
				
				return $this->success( "Sign up successful", 201, $user_id);
				
			} catch (\Exception $e) {
				return $this->error("Problem in sign up", 500, $e->getMessage());
			}
		}

//    GENERATE AUTH TOKEN FOR USER
		public function login(Request $request)
		{
			try {
				info('Creating token');
				
				// VALIDATE CREDENTIALS
				$credentials = $request->validate([
					'email' => 'required|string|email',
					'password' => 'required|string|min:6'
				]);
				
				return $this->userService->userLogin($credentials);
				
			} catch (\Exception $e) {
				return $this->error("Problem in sign in", 500, $e->getMessage());
			}
		}
		
	}
