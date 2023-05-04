<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;

        $permissionArray[$i]['name']       = 'dashboard';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'ticket';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'ticket_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'ticket_edit';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'ticket_show';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'ticket_destroy';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'faq';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'faq_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'faq_edit';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'faq_show';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'faq_destroy';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'user';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'user_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'user_edit';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'user_show';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'user_destroy';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'conversation';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'category';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'category_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'category_edit';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'category_destroy';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'role';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'role_create';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'role_edit';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'role_destroy';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'permission';
        $permissionArray[$i]['guard_name'] = 'web';

        $i++;
        $permissionArray[$i]['name']       = 'setting';
        $permissionArray[$i]['guard_name'] = 'web';

        Permission::insert($permissionArray);
    }
}
