<?php

namespace Database\Seeders;

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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        
        \App\Models\User::factory(10)->hasProfile()->hasPosts(5)->create();
        \App\Models\Comment::factory(2)->create();
        \App\Models\Doubt::factory(5)->create();
    }
}
