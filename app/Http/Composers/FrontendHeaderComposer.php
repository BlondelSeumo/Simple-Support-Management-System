<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class FrontendHeaderComposer
{
    public function compose(View $view)
    {
        $clientRole = Role::find(3);
        $view->with('clientRole', $clientRole);
    }
}
