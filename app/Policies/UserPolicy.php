<?php

namespace App\Policies;

use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 只有当前用户和修改用户的 Id 一摸一样才能确实的同一个用户,才能修改
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    // 只有当前用户是管理员且不能删除自己
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

}
