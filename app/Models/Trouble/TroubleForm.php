<?php

namespace App\Models\Trouble;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $area_stand_id
 * @property int $user_id
 * @property int $network_type
 * @property int $category
 * @property int $network_name
 * @property string $name
 * @property string $position
 * @property string $distance
 * @property string $reason
 * @property string $unit
 * @property string $person
 * @property string $mobile
 * @property boolean $influence
 * @property boolean $deal_with
 * @property boolean $suggest
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 */
class TroubleForm extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'area_stand_id', 'user_id', 'network_type', 'category', 'network_name', 'name', 'position',
        'distance', 'reason', 'unit', 'person', 'mobile', 'influence', 'deal_with', 'suggest', 'status',
        'created_at', 'updated_at'
    ];

    const MOBILE_NETWORK = 1;
    const FIXED_NETWORK = 2;
    const MOBILE_NETWORK_TEXT = '移网';
    const FIXED_NETWORK_TEXT = '固网';

    /**
     * 网络类型
     * @return string[]
     */
    public static function getAllNetworkType()
    {
        return [
            self::MOBILE_NETWORK => self::MOBILE_NETWORK_TEXT,
            self::FIXED_NETWORK => self::FIXED_NETWORK_TEXT,
        ];
    }

    public static function getNetWorkMajor($type)
    {
        return self::netWorkMajor()[$type];
    }

    public static function getNetWorkName($num)
    {
        return self::netWorkName()[$num];
    }

    /**
     * 网络专业类别
     * @return array
     */
    public static function netWorkMajor()
    {
        return [
            self::MOBILE_NETWORK => [
                '动力空调',
                '机房综合',
                '铁塔天馈'
            ],
            self::FIXED_NETWORK => [
                '传输路线',
                '动力空调',
                '公众客户',
                '机房综合',
                '集团客户'
            ]
        ];
    }

    /**
     * 网络专业名称
     */
    public static function netWorkName()
    {
        return [
            ['动力设备', '空调设备'],
            ['宏基站', '室外站', '室分点'],
            ['单塔'],
            ['一级干线', '二级干线', '本地网', '接入网'],
            ['动力设备', '空调设备'],
            ['数固客户'],
            ['一体化接入机房', '核心机房', '汇聚机房', '接入机房', '客户机房'],
            ['跨省跨域客户', '本地一级集团客户', '本地二级集团客户', '本地三级集团客户']
        ];
    }


}
