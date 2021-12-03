<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ark',
            'email' => 'arkefallen@gmail.com',
            'password' => bcrypt('userark'),
            'level' => 'user'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('useradmin'),
            'level' => 'admin'
        ]);
    }
}
