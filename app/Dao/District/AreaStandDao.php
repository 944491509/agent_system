<?php


namespace App\Dao\District;


use App\Dao\ChinaAreaDao;
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


    /**
     * 获取有项目部的城市
     * @return array
     */
    public function getAreaStandCity() {
        $cityId = AreaStand::whereNotNull('city_id')
            ->select('city_id')
            ->distinct()
            ->get()
            ->pluck('city_id');
        $chinaAreaDao = new ChinaAreaDao();
        $data = $chinaAreaDao->getAreasByCodeArr($cityId);
        $area = [];
        foreach ($data as $key => $val) {
            $area[$val['code']] = $val['name'];
        }
        return $area;
    }


    /**
     * 根据名称获取项目部
     * @param $name
     * @return mixed
     */
    public function getAreaStandByName($name) {
        $map = ['name'=>$name];
        return AreaStand::where($map)->first();
    }

}
