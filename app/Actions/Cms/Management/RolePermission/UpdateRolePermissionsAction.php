<?php

namespace App\Actions\Cms\Management\RolePermission;

use App\Models\Spatie\Permission;
use Spatie\Permission\Models\Role;

class UpdateRolePermissionsAction
{
    /**
     * Assign all permissions to the role.
     *
     * @param Role $role
     * @return void
     */
    public function assignAll(Role $role): void
    {
        $role->syncPermissions(Permission::all()->pluck('name')->toArray());
    }

    /**
     * Revoke all permissions from the role.
     *
     * @param Role $role
     * @return void
     */
    public function revokeAll(Role $role): void
    {
        $role->syncPermissions([]);
    }

    /**
     * Assign a specific permission to the role.
     *
     * @param Role $role
     * @param string $permissionName
     * @return void
     */
    public function assign(Role $role, string $permissionName): void
    {
        $role->givePermissionTo($permissionName);
    }

    /**
     * Revoke a specific permission from the role.
     *
     * @param Role $role
     * @param string $permissionName
     * @return void
     */
    public function revoke(Role $role, string $permissionName): void
    {
        $role->revokePermissionTo($permissionName);
    }
}
