<?php


//preso da: https://medium.com/swlh/api-authentication-using-laravel-sanctum-laravel-8-19ed8b4f124c
	
	namespace App\Traits;
	
	/*
	|--------------------------------------------------------------------------
	| Api Responser Trait
	|--------------------------------------------------------------------------
	|
	| This trait will be used to check if a name is a duplicate in the model
	|
	*/
	
	trait NameBuilder
	{
		public function buildName(string $name, $model)
		{
			$duplicates = $model::where('name', 'LIKE', '%' . $name . '%')->count();
			if ($duplicates > 0) {
				info('Model with that name already exists. Changing name');
				return $name . ' (' . $duplicates . ')';
			}
			
			return $name;
		}
	}
