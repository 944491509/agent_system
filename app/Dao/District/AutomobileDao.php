<?php


namespace App\Dao\District;


use App\Models\District\Automobile;

class AutomobileDao
{



    /**
     * Excel数据导入
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function addExcel($data) {
        $this->judgeIsCanNull($data);
        // 查询该车牌是否存在
        $re = $this->getAutomobileByNumber($data[0]);
        if(!is_null($re)) {
           throw new \Exception($data[0]."该车牌号已存在");
        }
        // 查询项目部
        $areaStandDao = new AreaStandDao();
        $areaStand = $areaStandDao->getAreaStandByName($data[2]);
        if(is_null($areaStand)) {
            throw new \Exception($data[2]."不存在");
        }
        // 驾驶员
        $userDao = new UserDao();
        $map = ["name"=>$data[3],'area_stand_id'=>$areaStand['id'], 'vehicle_card' => 1];
        $user = $userDao->getUser($map);
        if(is_null($user)) {
            throw new \Exception($data[2]."驾驶员".$data[3]."不存在");
        }
        $model = new Automobile();
        // 车辆类型
        $allType = $model->allCatType();
        $type = array_search($data[1], $allType);
        if($type == false) {
            throw new \Exception($data[1]."类别不存在");
        }
        // 性质
        $allNature = $model->allNature();
        $nature = array_search($data[4], $allNature);
        if($nature == false) {
            throw new \Exception($data[4]."性质不存在");
        }
        // 用途
        $allUse = $model->allUse();
        $use = array_search($data[5], $allUse);
        if($use == false) {
            throw new \Exception($data[5]."车辆用途不存在");
        }

        $config = $this->config();
        $field = array_column($config, 'field');
        $add = [];
        foreach ($field as $key => $item) {
            $add[$item] = $data[$key];
        }

        $add['stand_id'] = $areaStand['id'];
        $add['user_id'] = $user['id'];
        $add['type'] = $type;
        $add['nature'] = $nature;
        $add['use'] = $use;
        return Automobile::create($add);
    }


    /**
     * 根据车牌号查询
     * @param $number
     * @return mixed
     */
    public function getAutomobileByNumber($number) {
        $map = ['number'=>$number];
        return Automobile::where($map)->first();
    }

    /**
     * 判断字段是否可以为空
     * @param $data
     * @throws \Exception
     */
    public function judgeIsCanNull ($data) {
        $config = $this->config();
        $name = array_column($config, 'name');
        $isNull = array_column($config, 'is_null');
        foreach ($data as $key => $item) {
            if (!$isNull[$key] && empty($item)) {
                throw new \Exception($name[$key]."不能为空!");
            }
        }
    }


    /**
     * excel字段
     * @return array[]
     */
    public function config() {
        return [
            [
                "name" => "车牌号",
                "is_null" => false,
                "field" => "number",
            ],
            [
                "name" => "类别",
                "is_null" => false,
                "field" => "type",
            ],
            [
                "name" => "项目部",
                "is_null" => false,
                "field" => "stand_id",
            ],
            [
                "name" => "驾驶员",
                "is_null" => false,
                "field" => "user_id",
            ],
            [
                "name" => "性质",
                "is_null" => false,
                "field" => "nature",
            ],
            [
                "name" => "车辆用途",
                "is_null" => false,
                "field" => "use",
            ],
            [
                "name" => "车主",
                "is_null" => true,
                "field" => "car_owner",
            ],
            [
                "name" => "车辆厂家",
                "is_null" => true,
                "field" => "manufacturers",
            ],
            [
                "name" => "购买价格",
                "is_null" => true,
                "field" => "price",
            ],
            [
                "name" =>  "租金",
                "is_null" => true,
                "field" => "rent",
            ],
            [
                "name" => "购入时间",
                "is_null" => true,
                "field" => "bought_at",
            ],
            [
                "name" =>  "车辆型号",
                "is_null" => true,
                "field" => "model",
            ],
            [
                "name" => "车辆排量",
                "is_null" => true,
                "field" => "displacement",
            ],
            [
                "name" => "购入单位",
                "is_null" => true,
                "field" => "bought_company",
            ],
            [
                "name" => "日常油耗",
                "is_null" => true,
                "field" => "oil_wear",
            ],
            [
                "name" => "发动机号",
                "is_null" => true,
                "field" => "engine_num",
            ],
            [
                "name" => "车架号",
                "is_null" => true,
                "field" => "vin",
            ],
            [
                "name" => "载重",
                "is_null" => true,
                "field" => "loads",
            ],
            [
                "name" => "车辆说明",
                "is_null" => true,
                "field" => "explain",
            ],
        ];
    }
}
