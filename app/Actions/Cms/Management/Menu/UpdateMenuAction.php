<?php

namespace App\Actions\Cms\Management\Menu;

use App\Models\Menu\Menu;

class UpdateMenuAction
{
    /**
     * Handle the action.
     *
     * @param Menu $menu
     * @param array $data
     * @return bool
     */
    public function handle(Menu $menu, array $data): bool
    {
        return $menu->update($data);
    }
}
