<?php

namespace App\Actions\Cms\MenuSub;

use App\Models\Menu\MenuSub;

class DeleteMenuSubAction
{
    /**
     * Handle the action.
     *
     * @param MenuSub $menuSub
     * @return bool|null
     */
    public function handle(MenuSub $menuSub): ?bool
    {
        return $menuSub->delete();
    }
}
