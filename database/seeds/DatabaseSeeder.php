<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        factory(Rosa\User::class, 50)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
