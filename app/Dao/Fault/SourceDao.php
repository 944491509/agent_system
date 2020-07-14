<?php


namespace App\Dao\Fault;


use App\Models\Fault\NetworkFaultSource;

class SourceDao
{

    /**
     * 根据项目部查询故障来源
     * @param $areaStandId
     * @return mixed
     */
    public function getSourcesByAreaStandId($areaStandId) {
        $map = ['area_stand_id' => $areaStandId];
        return NetworkFaultSource::where($map)->get();
    }
}
