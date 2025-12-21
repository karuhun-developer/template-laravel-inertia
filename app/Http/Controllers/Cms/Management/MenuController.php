<?php

namespace App\Http\Controllers\Cms\Management;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use App\Models\Spatie\Role;
use App\Traits\WithGetFilterData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    use WithGetFilterData;

    protected string $resource = Menu::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('view'.$this->resource);

        $order = $request?->order ?? 'desc';
        $orderBy = $request?->orderBy ?? 'menus.order';
        $paginate = $request?->paginate ?? 10;
        $searchBySpecific = $request?->searchBySpecific ?? '';
        $search = $request?->search ?? '';

        // Query
        $model = Menu::query()
            ->join('roles', 'menus.role_id', '=', 'roles.id')
            ->select(
                'menus.*',
                'roles.name as role_name',
            );
        $model = $this->getDataWithFilter(
            model: $model,
            searchBy: [
                'roles.name',
                'menus.name',
                'menus.url',
                'menus.icon',
                'menus.order',
                'menus.active_pattern',
            ],
            order: $order,
            orderBy: $orderBy,
            paginate: $paginate,
            searchBySpecific: $searchBySpecific,
            s: $search,
        );

        return inertia('cms/management/menu/Index', [
            'data' => $model,
            'order' => $order,
            'orderBy' => $orderBy,
            'paginate' => $paginate,
            'searchBySpecific' => $searchBySpecific,
            'search' => $search,
            'resource' => $this->resource,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create'.$this->resource);

        return inertia('cms/management/menu/Create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create'.$this->resource);

        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer',
            'active_pattern' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        Menu::create($validated);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        Gate::authorize('update'.$this->resource);

        return inertia('cms/management/menu/Edit', [
            'menu' => $menu,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        Gate::authorize('update'.$this->resource);

        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer',
            'active_pattern' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $menu->update($validated);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        Gate::authorize('delete'.$this->resource);

        $menu->delete();

        return back();
    }
}
