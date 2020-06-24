<?php

namespace App\Models\District;

use App\Models\ChinaArea;
use Illuminate\Database\Eloquent\Model;

class AreaStand extends Model
{


    /**
     * @var array
     */
    protected $fillable = [
        'id', 'province_id', 'city_id', 'district_id', 'name', 'operator', 'explain',
        'remark', 'type', 'level', 'area_id'
    ];

    public $casts = [
        'type' => 'array',
        'operator' => 'array',
        'explain' => 'array',
    ];


    // 区域说明
    const MOBILE_NETWORK = 1;
    const FIXED_NETWORK = 2;
    const MOBILE_NETWORK_TEXT = '移网';
    const FIXED_NETWORK_TEXT = '固网';

    const PROVINCE_LEVEL = 1;
    const CITY_LEVEL = 2;
    const DISTRICT_LEVEL = 3;

    const PROVINCE_LEVEL_TEXT = '省级';
    const CITY_LEVEL_TEXT = '市级';
    const DISTRICT_LEVEL_TEXT = '区/县级';



    /**
     * 区域网络说明
     * @return string[]
     */
    public function getAllExplain() {
        return [
            self::MOBILE_NETWORK => self::MOBILE_NETWORK_TEXT,
            self::FIXED_NETWORK => self::FIXED_NETWORK_TEXT,
        ];
    }


    /**
     * 所有的等级
     * @return string[]
     */
    public function getAllLevel() {
        return [
            self::PROVINCE_LEVEL => self::PROVINCE_LEVEL_TEXT,
            self::CITY_LEVEL => self::CITY_LEVEL_TEXT,
            self::DISTRICT_LEVEL => self::DISTRICT_LEVEL_TEXT,
        ];
    }




    /**
     * 获取当前区域网络说明
     * @return string
     */
    public function explainText() {
        $explain = $this->getAllExplain();
        return $explain[$this->explain] ?? '';
    }


    /**
     * 省份
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province() {
        return $this->belongsTo(ChinaArea::class, 'province_id','code');

    }


    /**
     * 城市
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city() {
        return $this->belongsTo(ChinaArea::class, 'city_id','code');
    }


    /**
     * 区县
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district() {
        return $this->belongsTo(ChinaArea::class, 'district_id','code');

    }

}
