<?php

use App\Enums\GroupAuthority;
use App\Enums\GroupStatus;
use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::insert([
            [
                'name'       => 'Group 1',
                'authority'  => GroupAuthority::GROUP_PUBLIC,
                'status'     => GroupStatus::ACTIVE,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Group 2',
                'authority'  => GroupAuthority::GROUP_PUBLIC,
                'status'     => GroupStatus::ACTIVE,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Group 3',
                'authority'  => GroupAuthority::GROUP_PUBLIC,
                'status'     => GroupStatus::ACTIVE,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Group 4',
                'authority'  => GroupAuthority::GROUP_PUBLIC,
                'status'     => GroupStatus::ACTIVE,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
