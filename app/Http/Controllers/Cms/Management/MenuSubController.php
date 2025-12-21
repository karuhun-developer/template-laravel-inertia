<?php

namespace App\Http\Controllers\Cms\Management;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuSub;
use App\Models\Spatie\Role;
use App\Traits\WithGetFilterData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuSubController extends Controller
{
    use WithGetFilterData;

    protected string $resource = MenuSub::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Menu $menu)
    {
        Gate::authorize('view'.$this->resource);

        $order = $request?->order ?? 'desc';
        $orderBy = $request?->orderBy ?? 'menu_subs.order';
        $paginate = $request?->paginate ?? 10;
        $searchBySpecific = $request?->searchBySpecific ?? '';
        $search = $request?->search ?? '';

        // Query
        $model = MenuSub::query()
            ->join('menus', 'menu_subs.menu_id', '=', 'menus.id')
            ->where('menu_subs.menu_id', $menu->id)
            ->select(
                'menu_subs.*',
                'menus.name as menu_name',
            );
        $model = $this->getDataWithFilter(
            model: $model,
            searchBy: [
                'menus.name',
                'menu_subs.name',
                'menu_subs.url',
                'menu_subs.icon',
                'menu_subs.order',
                'menu_subs.active_pattern',
            ],
            order: $order,
            orderBy: $orderBy,
            paginate: $paginate,
            searchBySpecific: $searchBySpecific,
            s: $search,
        );

        return inertia('cms/management/menu-sub/Index', [
            'data' => $model,
            'menu' => $menu,
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
    public function create(Menu $menu)
    {
        Gate::authorize('create'.$this->resource);

        return inertia('cms/management/menu-sub/Create', [
            'menu' => $menu,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Menu $menu)
    {
        Gate::authorize('create'.$this->resource);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer',
            'active_pattern' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $validated['menu_id'] = $menu->id;
        $validated['role_id'] = $menu->role_id;

        MenuSub::create($validated);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu, MenuSub $subMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu, MenuSub $subMenu)
    {
        Gate::authorize('update'.$this->resource);

        return inertia('cms/management/menu-sub/Edit', [
            'subMenu' => $subMenu,
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu, MenuSub $subMenu)
    {
        Gate::authorize('update'.$this->resource);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer',
            'active_pattern' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $subMenu->update($validated);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, MenuSub $subMenu)
    {
        Gate::authorize('delete'.$this->resource);

        $subMenu->delete();

        return back();
    }
}
