<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
          'name' => 'root', 'spotify_id' => '1', 'email' => 'root@root.com',
          'password' => bcrypt('secret')
          ]);
    }
}
