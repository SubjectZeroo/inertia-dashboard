<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Country;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5000)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([PermissionSeeder::class]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret',
        ]);

        $role = Role::findByName('Super Admin');

        $role->users()->attach($user);

        // User::factory(['email' => 'info@geisi.dev'])
        //     ->withPersonalTeam()
        //     ->hasAttached(Team::factory()->count(3))
        //     ->create();

        $country = Country::factory()->create([
            'name' => 'Venezuela',
            'full_name' => 'Venezuela',
            // 'code' => NULL,
        ]);



        $this->call(StateSeeder::class);
    }
}
