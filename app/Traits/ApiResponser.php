<?php


//preso da: https://medium.com/swlh/api-authentication-using-laravel-sanctum-laravel-8-19ed8b4f124c
	
	namespace App\Traits;
	
	/*
	|--------------------------------------------------------------------------
	| Api Responser Trait
	|--------------------------------------------------------------------------
	|
	| This trait will be used for any response we sent to clients.
	|
	*/
	
	trait ApiResponser
	{
		/**
		 * Return a success JSON response.
		 *
		 * @param array|string $data
		 * @param string $message
		 * @param int|null $code
		 * @return \Illuminate\Http\JsonResponse
		 */
		protected function success(string $message = null, int $code = 200, $data = null)
		{
			return response()->json([
				'status' => 'Success',
				'message' => $message,
				'data' => $data
			], $code);
		}
		
		/**
		 * Return an error JSON response.
		 *
		 * @param string $message
		 * @param int $code
		 * @param array|string|null $data
		 * @return \Illuminate\Http\JsonResponse
		 */
		protected function error(string $message = null, int $code, $data = null)
		{
			return response()->json([
				'status' => 'Error',
				'message' => $message,
				'data' => $data
			], $code);
		}
		
	}
