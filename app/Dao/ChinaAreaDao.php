<?php


namespace App\Dao;


use App\Models\ChinaArea;

class ChinaAreaDao
{

    /**
     * @param null $Id
     * @return mixed
     */
    public function getArea($Id = null) {
        if(is_null($Id)) {
            $map = ['parent_id' => ChinaArea::CHINA];
        } else {
            $map = ['parent_id' => $Id];
        }
        $field = ['id', 'name as text'];
        return ChinaArea::where($map)->select($field)->get();
    }


    public function areas($id = null) {
        if(is_null($id)) {
            $id = ChinaArea::CHINA;
        }
        $data = $this->getArea($id);
        $area = [];
        foreach ($data as $key => $item) {
            $area[$item->id] = $item->name;
        }
        return $area;
    }

}
