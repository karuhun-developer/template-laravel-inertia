<?php

namespace App\Actions\Cms\Management\Menu;

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
