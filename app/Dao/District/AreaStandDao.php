<?php


namespace App\Dao\District;


use App\Models\District\AreaStand;

class AreaStandDao
{
    /**
     * 查询所有项目部
     */
    public function getAllAreaStand()
    {
        return AreaStand::all();
    }

}
