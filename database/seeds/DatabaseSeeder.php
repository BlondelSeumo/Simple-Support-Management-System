<?php

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
        $this->call(BackendMenuTableSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
