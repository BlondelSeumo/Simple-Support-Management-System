<?php

use App\Models\BackendMenu;
use Illuminate\Database\Seeder;

class BackendMenuTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name'      => 'Dashboard',
                'link'      => 'dashboard',
                'icon'      => 'fa fa-tachometer-alt',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Ticket',
                'link'      => 'ticket',
                'icon'      => 'fas fa-fw fa-ticket-alt',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Conversation',
                'link'      => 'conversation',
                'icon'      => 'fas fa-fw fa-comments',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Faq',
                'link'      => 'faq',
                'icon'      => 'fas fa-question-circle',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Category',
                'link'      => 'category',
                'icon'      => 'fas fa-cart-plus',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'User',
                'link'      => 'user',
                'icon'      => 'fas fa-users',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Item',
                'link'      => 'item',
                'icon'      => 'fas fa-cart-plus',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Role',
                'link'      => 'role',
                'icon'      => 'fas fa-sliders-h',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Permission',
                'link'      => 'permission',
                'icon'      => 'fas fa-user-shield',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
            [
                'name'      => 'Setting',
                'link'      => 'setting',
                'icon'      => 'fas fa-cogs',
                'parent_id' => 0,
                'priority'  => 1000,
                'status'    => 1,
            ],
        ];

        BackendMenu::insert($menus);
    }
}
