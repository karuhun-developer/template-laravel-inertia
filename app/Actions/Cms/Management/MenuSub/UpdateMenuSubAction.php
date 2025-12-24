<?php

namespace App\Actions\Cms\Management\MenuSub;

use App\Models\Menu\MenuSub;

class UpdateMenuSubAction
{
    /**
     * Handle the action.
     *
     * @param MenuSub $menuSub
     * @param array $data
     * @return bool
     */
    public function handle(MenuSub $menuSub, array $data): bool
    {
        return $menuSub->update($data);
    }
}
