<?php
// app/Library/Services/Contracts/AuthenticationServiceInterface.php
	namespace App\Contracts;
	
//	use App\Models\Group;
//	use App\Models\User;
	
	Interface ApiInterface
	{
		public function getAll();
		public function getOne(string $entity_id);
		public function create(array $data);
		public function update(string $entity_id, array $data);
		public function delete(string $entity_id);
	}