<?php


namespace App\Dao\District;


use App\Models\District\Department;

class DepartmentDao
{

    /**
     * 根据项目部ID获取部门
     * @param $standId
     * @return mixed
     */
    public function getDepartmentsByStandId($standId) {
        $map = ['area_stand_id'=>$standId];
        return Department::where($map)->get();
    }

}
