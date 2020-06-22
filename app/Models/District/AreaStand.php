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
        'id', 'city_id', 'district_id', 'name', 'operator', 'explain', 'remark'
    ];


    // 运营商
    const LINK = 1;
    const MOVE = 2;
    const TELECOM = 3;
    const LINK_TEXT = '联通';
    const MOVE_TEXT = '移动';
    const TELECOM_TEXT = '电信';

    // 区域说明
    const MOBILE_NETWORK = 1;
    const FIXED_NETWORK = 2;
    const MOBILE_FIXED_NETWORK = 3;
    const MOBILE_NETWORK_TEXT = '移网';
    const FIXED_NETWORK_TEXT = '固网';
    const MOBILE_FIXED_NETWORK_TEXT = '移网/固网';


    /**
     * 获取全部运营商
     * @return string[]
     */
    public function getAllOperator() {
        return [
            self::LINK => self::LINK_TEXT,
            self::MOVE => self::MOVE_TEXT,
            self::TELECOM => self::TELECOM_TEXT,
        ];
    }

    /**
     * 获取当前运营商
     * @return string
     */
    public function operatorText() {
        $operator = $this->getAllOperator();
        return $operator[$this->operator] ?? '';
    }



    /**
     * 区域网络说明
     * @return string[]
     */
    public function getAllExplain() {
        return [
            self::MOBILE_NETWORK => self::MOBILE_NETWORK_TEXT,
            self::FIXED_NETWORK => self::FIXED_NETWORK_TEXT,
            self::MOBILE_FIXED_NETWORK => self::MOBILE_FIXED_NETWORK_TEXT
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
