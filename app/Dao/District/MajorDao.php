<?php


namespace App\Dao\District;


use App\Models\District\Major;

class MajorDao
{
    /**
     * 根据岗位ID 获取专业
     * @param $id
     * @return mixed
     */
    public function getMajorByPostId($id)
    {
        return Major::where('post_id', $id)->get();
    }


}
