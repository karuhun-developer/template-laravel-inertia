<?php

namespace App\Actions\Cms\Role;

use App\Models\Spatie\Role;

class DeleteRoleAction
{
    /**
     * Handle the action.
     *
     * @param Role $role
     * @return bool|null
     */
    public function handle(Role $role): ?bool
    {
        return $role->delete();
    }
}
