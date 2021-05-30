<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
   public function run()
   {
      DB::table('users')->insert([
         'name' => 'Daniel García',
         'email' => 'serempre@gmail.com',
         'password' => Hash::make('secret'),
         'state' => 1
      ]);
   }
}
