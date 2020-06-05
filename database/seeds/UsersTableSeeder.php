<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name' => "Name 1",
        	'email' => "email@domain.com",
        	'password' => bcrypt("pass")
        ]);
    }
}