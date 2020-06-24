<?php
namespace App\Dao\District;


use App\Models\District\Facilitators;

class FacilitatorDao
{

    /**
     * 查询所有的服务商
     * @return mixed
     */
    public function getFacilitators() {
        $map = ['status' =>Facilitators::SHOW];
        return Facilitators::where($map)->get();
    }


    /**
     * 数据格式处理
     * @return array
     */
    public function facilitators() {
        $data = $this->getFacilitators();
        $facilitators = [];
        foreach ($data as $key => $item) {
            $facilitators[$item->id] = $item->name;
        }
        return $facilitators;
    }
}
