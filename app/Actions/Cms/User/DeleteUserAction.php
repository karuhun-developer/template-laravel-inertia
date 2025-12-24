<?php

namespace App\Actions\Cms\User;

use App\Models\User;

class DeleteUserAction
{
    /**
     * Handle the action.
     *
     * @param User $user
     * @return bool|null
     */
    public function handle(User $user): ?bool
    {
        return $user->delete();
    }
}
