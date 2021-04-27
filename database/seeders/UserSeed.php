<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		$now = Carbon::now();

		User::create([
			'name'					=>	'Vitor de Sousa',
			'email'					=>	'admin@admin.com',
			'password'				=>	bcrypt('password'),
			'email_verified_at'		=>	$now,
			'remember_token'		=>	Str::random(10),
			'created_at'			=>	$now,
			'updated_at'			=>	$now,
		]);
	}
}
