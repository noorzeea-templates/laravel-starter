<?php
	
	use App\Http\Controllers\AuthenticationController;
	use App\Models\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

	
	Route::post('/register', [AuthenticationController::class, 'register'])
		->name('register');
	
	Route::post('/login', [AuthenticationController::class, 'login'])
		->name('login');
	
	
	// AUTH APIS (FOR AUTHENTICATED USER)
	Route::middleware(['auth:sanctum'])
		->group(function () {
			
			// GET LOGGED USER DATA
			Route::get('/profile', function () {
				return Auth::user();
			})->name('profile');

			// GET USERS LIST
			Route::get('/users/all', function () {
				return User::all();
			})->name('all-users');
			
			// LOGOUT USER
			Route::delete('/logout', [AuthenticationController::class, 'logout'])
				->name('logout');
			
		});