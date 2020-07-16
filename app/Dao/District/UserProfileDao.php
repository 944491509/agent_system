<?php

namespace App\Dao\District;

use App\Models\District\UserProfile;

class UserProfileDao
{

    /**
     * 根据项目部获取所有人员
     * @param $standId
     * @return mixed
     */
    public function getAllPersonnelByStandId($standId)
    {
        return UserProfile::where('area_stand_id', $standId)->get();
    }

}
