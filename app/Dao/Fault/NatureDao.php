<?php


namespace App\Dao\Fault;


use App\Models\Fault\NetworkFaultNature;
use App\Models\Fault\NetworkFaultTime;

class NatureDao
{

    /**
     * 根据来源查询故障性质
     * @param $sourceId
     * @return mixed
     */
    public function getNatureBySourceId($sourceId) {
        $map = ['source_id'=>$sourceId];
        return NetworkFaultNature::where($map)->get();
    }


    /**
     * 根据性质查询时限
     * @param $natureId
     * @return mixed
     */
    public function getTimesByNatureId($natureId) {
        $map = ['nature_id' => $natureId];
        return NetworkFaultTime::where($map)->get();
    }
}
