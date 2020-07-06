<?php

namespace App\Dao\District;

use App\Models\District\TaskGroup;

class TaskGroupDao
{

    /**
     * 根据部门ID 获取班组
     * @param $id
     * @return mixed
     */
    public function getGroupByDepartmentId($id)
    {
        return TaskGroup::where('department_id', $id)->get();
    }


}
