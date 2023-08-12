<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CategoriesSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(PermissionsSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(Role_has_permissionsSeeder::class);
        // $this->call(Model_has_rolesSeeder::class);
    }
}
