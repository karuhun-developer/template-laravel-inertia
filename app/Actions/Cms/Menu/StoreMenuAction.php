<?php

namespace App\Actions\Cms\Menu;

use App\Models\Menu\Menu;

class StoreMenuAction
{
    /**
     * Handle the action.
     *
     * @param array $data
     * @return Menu
     */
    public function handle(array $data): Menu
    {
        return Menu::create($data);
    }
}
