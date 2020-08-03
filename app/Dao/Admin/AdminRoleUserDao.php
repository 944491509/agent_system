<?php


namespace App\Dao\Admin;


use App\Models\Admin\AdminRoleUser;

class AdminRoleUserDao
{
    public function getUserRoleByUserId($userId)
    {
        return AdminRoleUser::where('user_id', $userId)->value('role_id');
    }
}
