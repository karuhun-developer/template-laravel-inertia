<?php

namespace App\Http\Controllers\Cms\Management;

use App\Http\Controllers\Controller;
use App\Models\Spatie\Permission;
use App\Models\Spatie\Role;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class RolePermissionController extends Controller
{
    protected string $resource = Role::class;

    public function index(SpatieRole $role)
    {
        Gate::authorize('validate'.$this->resource);

        return inertia('cms/management/role/Permission', [
            'role' => $role,
            'permissions' => Inertia::defer(fn () => $this->getPermissions($role)),
        ]);
    }

    /**
     *
     * Get all permissions.
     *
     */
    private function getPermissions(SpatieRole $role)
    {
        $permissionSources = Permission::all();
        $permissions = [];

        // Get all permission sources
        foreach ($permissionSources as $perm) {
            $perm = explode('App\\', $perm->name);
            $model = 'App\\'.$perm[1];
            $permission = $perm[0];

            $permissions[$model][$permission] = false;
        }

        // Check if role has permissions
        foreach ($role->permissions->pluck('name') as $perm) {
            $perm = explode('App\\', $perm);
            $model = 'App\\'.$perm[1];
            $permission = $perm[0];

            $permissions[$model][$permission] = true;
        }

        return $permissions;
    }

    public function checkAllPermissions(SpatieRole $role)
    {
        Gate::authorize('update'.$this->resource);

        $role->syncPermissions(Permission::all()->pluck('name')->toArray());

        return back();
    }

    public function uncheckAllPermissions(SpatieRole $role)
    {
        Gate::authorize('update'.$this->resource);

        $role->syncPermissions([]);

        return back();
    }

    public function checkPermissions(Request $request, SpatieRole $role)
    {
        Gate::authorize('update'.$this->resource);

        $permission = Permission::where('name', $request->permission)->firstOrFail();
        $role->givePermissionTo($request->permission);

        return back();
    }

    public function uncheckPermissions(Request $request, SpatieRole $role)
    {
        Gate::authorize('update'.$this->resource);

        $permission = Permission::where('name', $request->permission)->firstOrFail();
        $role->revokePermissionTo($request->permission);

        return back();
    }
}
