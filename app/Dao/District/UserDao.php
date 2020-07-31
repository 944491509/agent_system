<?php


namespace App\Dao\District;

use App\Models\District\User;

class UserDao
{

    /**
     * 查询当前项目部的司机
     * @param $standId
     * @return mixed
     */
    public function getDriverByStandId($standId) {
        $map = ['area_stand_id'=>$standId, 'vehicle_card' => 1];
        $field = ['users.id', 'name'];
        return User::join('user_profiles','users.id', '=', 'user_profiles.user_id')
            ->where($map)->select($field)->get();
    }


    /**
     * 查询user
     * @param $map
     * @return mixed
     */
    public function getUser($map) {
        $field = ['users.id', 'name'];
        return User::join('user_profiles','users.id', '=', 'user_profiles.user_id')
        ->where($map)->select($field)->first();
    }


}
