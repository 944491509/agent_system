<?php


namespace App\Dao;


use App\Models\ChinaArea;

class ChinaAreaDao
{

    /**
     * @param null $code
     * @return mixed
     */
    public function getArea($code = null) {
        if(is_null($code)) {
            $map = ['parent_id' => ChinaArea::CHINA];
        } else {
            $area = $this->getAreaInfoByCode($code);
            $map = ['parent_id' => $area['id']];
        }
        $field = ['code as id', 'name as text'];
        return ChinaArea::where($map)->select($field)->get();
    }


    /**
     * 详情
     * @param $code
     * @return mixed
     */
    public function getAreaInfoByCode($code) {
        $map = ['code'=>$code];
        return ChinaArea::where($map)->first();
    }


    /**
     * 获取地区
     * @param $codeArr
     * @return mixed
     */
    public function getAreasByCodeArr($codeArr) {
        return ChinaArea::whereIn('code',$codeArr)->get();
    }

}
