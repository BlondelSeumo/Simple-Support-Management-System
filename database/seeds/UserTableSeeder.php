<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'           => 'Mr Admin',
                'designation'    => 'Admin',
                'email'          => 'admin@example.com',
                'username'       => 'admin',
                'password'       => bcrypt('123456'),
                'phone'          => '+15005550006',
                'address'        => 'Mirpur 1, Dhaka, Bangladesh',
                'date_of_birth'  => date('Y-m-d H:i:s'),
                'joining_date'   => date('Y-m-d H:i:s'),
                'last_login_at'  => date('Y-m-d H:i:s'),
                'remember_token' => Str::random(10),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Mr Admin 1',
                'designation'    => 'Admin 1',
                'email'          => 'admin1@example.com',
                'username'       => 'admin1',
                'password'       => bcrypt('123456'),
                'phone'          => '+15005550006',
                'address'        => 'Mirpur 1, Dhaka, Bangladesh',
                'date_of_birth'  => date('Y-m-d H:i:s'),
                'joining_date'   => date('Y-m-d H:i:s'),
                'last_login_at'  => date('Y-m-d H:i:s'),
                'remember_token' => Str::random(10),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Mr Admin 2',
                'designation'    => 'Admin 2',
                'email'          => 'admin2@example.com',
                'username'       => 'admin2',
                'password'       => bcrypt('123456'),
                'phone'          => '+15005550006',
                'address'        => 'Mirpur 1, Dhaka, Bangladesh',
                'date_of_birth'  => date('Y-m-d H:i:s'),
                'joining_date'   => date('Y-m-d H:i:s'),
                'last_login_at'  => date('Y-m-d H:i:s'),
                'remember_token' => Str::random(10),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Mr Admin 3',
                'designation'    => 'Admin 3',
                'email'          => 'admin3@example.com',
                'username'       => 'admin3',
                'password'       => bcrypt('123456'),
                'phone'          => '+15005550006',
                'address'        => 'Mirpur 1, Dhaka, Bangladesh',
                'date_of_birth'  => date('Y-m-d H:i:s'),
                'joining_date'   => date('Y-m-d H:i:s'),
                'last_login_at'  => date('Y-m-d H:i:s'),
                'remember_token' => Str::random(10),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ]);

        $user = User::find(1);
        $role = Role::find(1);
        $user->assignRole($role->name);

        $user = User::find(2);
        $role = Role::find(2);
        $user->assignRole($role->name);

        $user = User::find(3);
        $role = Role::find(3);
        $user->assignRole($role->name);

        $user = User::find(4);
        $role = Role::find(3);
        $user->assignRole($role->name);
    }
}
