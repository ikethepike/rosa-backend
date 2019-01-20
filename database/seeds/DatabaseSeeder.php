<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        factory(Rosa\User::class, 50)->create()->each(function ($user) {
            $user->lessons()->save(factory(Rosa\Lesson::class)->make());
        });

        // Create one active term
        // factory(Rosa\Term::class, 1)->create();
    }
}
