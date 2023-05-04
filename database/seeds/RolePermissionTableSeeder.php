<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::find(1);
        $role->givePermissionTo(Permission::all());

        $supportPermission[]['name'] = 'dashboard';
        $supportPermission[]['name'] = 'ticket';
        $supportPermission[]['name'] = 'ticket_create';
        $supportPermission[]['name'] = 'ticket_edit';
        $supportPermission[]['name'] = 'ticket_show';
        $supportPermission[]['name'] = 'ticket_destroy';
        $supportPermission[]['name'] = 'faq';
        $supportPermission[]['name'] = 'faq_create';
        $supportPermission[]['name'] = 'faq_edit';
        $supportPermission[]['name'] = 'faq_show';
        $supportPermission[]['name'] = 'faq_destroy';
        $supportPermission[]['name'] = 'user';
        $supportPermission[]['name'] = 'user_create';
        $supportPermission[]['name'] = 'user_edit';
        $supportPermission[]['name'] = 'user_show';
        $supportPermission[]['name'] = 'user_destroy';
        $supportPermission[]['name'] = 'conversation';
        $supportPermission[]['name'] = 'category';
        $supportPermission[]['name'] = 'category_create';
        $supportPermission[]['name'] = 'category_edit';
        $supportPermission[]['name'] = 'category_destroy';
        $supportPermission[]['name'] = 'role';
        $supportPermission[]['name'] = 'setting';

        $permissions = Permission::whereIn('name', $supportPermission)->get();
        $role        = Role::find(2);
        $role->givePermissionTo($permissions);

        $clientPermission[]['name'] = 'dashboard';
        $clientPermission[]['name'] = 'ticket';
        $clientPermission[]['name'] = 'ticket_create';
        $clientPermission[]['name'] = 'ticket_show';
        $clientPermission[]['name'] = 'user_show';
        $clientPermission[]['name'] = 'conversation';
        $clientPermission[]['name'] = 'category';
        $clientPermission[]['name'] = 'role';

        $permissions = Permission::whereIn('name', $clientPermission)->get();
        $role        = Role::find(3);
        $role->givePermissionTo($permissions);
    }
}
