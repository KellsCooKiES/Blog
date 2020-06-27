<?php

namespace App\Policies;

use App\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Reply $reply
     * @return mixed
     */
    public function update(User $user,Reply $reply)
    {
        return $user->id == $reply->user_id;
    }
}
