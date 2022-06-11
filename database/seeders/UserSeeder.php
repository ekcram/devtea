<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $developerRole = Role::where('name', 'developer')->first();
        $moderatorRole = Role::where('name', 'moderator')->first();

        $superAdmin = User::create([
            'name' => 'super_admin',
            'surname' => 'Super Admin',
            'username' => 'superadmin',
            'is_admin' => 1,
            'date_of_birth' => '2022-01-01',
            'bio' => 'test',
            'country' => 'test',
            'gender' => 'test',
            'address' => 'test',
            'phone' => '123456789',
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'surname' => 'Administrador',
            'username' => 'admin',
            'is_admin' => 1,
            'date_of_birth' => '2022-01-01',
            'bio' => 'test',
            'country' => 'test',
            'gender' => 'test',
            'address' => 'test',
            'phone' => '123456789',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $developer = User::create([
            'name' => 'developer',
            'surname' => 'Developer',
            'username' => 'developer',
            'is_admin' => 1,
            'date_of_birth' => '2022-01-01',
            'bio' => 'test',
            'country' => 'test',
            'gender' => 'test',
            'address' => 'test',
            'phone' => '123456789',
            'email' => 'developer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $moderator = User::create([
            'name' => 'moderator',
            'surname' => 'Moderador',
            'username' => 'moderador',
            'is_admin' => 1,
            'date_of_birth' => '2022-01-01',
            'bio' => 'test',
            'country' => 'test',
            'gender' => 'test',
            'address' => 'test',
            'phone' => '123456789',
            'email' => 'moderator@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
        $developer->roles()->attach($developerRole);
        $moderator->roles()->attach($moderatorRole);
    }
}
