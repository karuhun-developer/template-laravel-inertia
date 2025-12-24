<?php

namespace App\Actions\Cms\Management\Menu;

use App\Models\Menu\Menu;

class DeleteMenuAction
{
    /**
     * Handle the action.
     *
     * @param Menu $menu
     * @return bool|null
     */
    public function handle(Menu $menu): ?bool
    {
        return $menu->delete();
    }
}
