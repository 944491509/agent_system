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


    /**
     * 为options处理数据
     * @return array
     */
    public function getAreaStandOption() {
        $stands = $this->getAllAreaStand();
        $areaStand = [];
        foreach ($stands as $key => $val) {
            $areaStand[$val['id']] = $val['name'];
        }
        return $areaStand;
    }

}
