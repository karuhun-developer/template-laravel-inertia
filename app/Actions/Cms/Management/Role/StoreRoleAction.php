<?php

namespace App\Actions\Cms\Management\Role;

use App\Models\Spatie\Role;

class StoreRoleAction
{
    /**
     * Handle the action.
     *
     * @param array $data
     * @return Role
     */
    public function handle(array $data): Role
    {
        return Role::create($data);
    }
}
