<?php

use Illuminate\Database\Seeder;
use App\Models\Trouble\TroubleData;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            '移网' => [
                '动力空调' => ['动力设备', '空调设备'],
                '机房综合' => ['宏基站', '室外站', '室分点'],
                '铁塔天馈' => ['单塔']
            ],
            '固网' => [
                '传输路线' => ['一级干线', '二级干线', '本地网', '接入网'],
                '动力空调' => ['动力设备', '空调设备'],
                '公众客户' => ['数固客户'],
                '机房综合' => ['一体化接入机房', '核心机房', '汇聚机房', '接入机房', '客户机房'],
                '集团客户' => ['跨省跨域客户', '本地一级集团客户', '本地二级集团客户', '本地三级集团客户']
            ]
        ];

        foreach ($arr as $key => $value) {
            $id = TroubleData::insertGetId(['p_id' => 0, 'name' => $key]);
            foreach ($value as $ke => $val) {
                $d = TroubleData::insertGetId(['p_id' => $id, 'name' => $ke]);
                foreach ($val as $k => $v) {
                    TroubleData::create(['p_id' => $d, 'name' => $v]);
                }
            }
        }

    }
}
