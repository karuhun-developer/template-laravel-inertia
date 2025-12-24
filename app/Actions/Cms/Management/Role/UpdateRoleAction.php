<?php

namespace App\Actions\Cms\Management\Role;

use App\Models\Spatie\Role;

class UpdateRoleAction
{
    /**
     * Handle the action.
     *
     * @param Role $role
     * @param array $data
     * @return bool
     */
    public function handle(Role $role, array $data): bool
    {
        return $role->update($data);
    }
}
