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
        'remark', 'type', 'level', 'area_id', 'parent_id',
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

    const TYPE_PROJECT = 1;
    const TYPE_MAINTAIN = 2;
    const TYPE_NETWORK = 3;
    const TYPE_MANAGE = 4;

    const TYPE_PROJECT_TEXT = '工程';
    const TYPE_MAINTAIN_TEXT = '维护';
    const TYPE_NETWORK_TEXT = '网优';
    const TYPE_MANAGE_TEXT = '管理';


    /**
     * 业务类型
     * @return string[]
     */
    public function getAllType() {
        return [
            self::TYPE_PROJECT => self::TYPE_PROJECT_TEXT,
            self::TYPE_MAINTAIN => self::TYPE_MAINTAIN_TEXT,
            self::TYPE_NETWORK => self::TYPE_NETWORK_TEXT,
            self::TYPE_MANAGE => self::TYPE_MANAGE_TEXT,
        ];
    }


    /**
     * 业务类型
     * @return string
     */
    public function typeText() {
        if(empty($this->type)) {
            return null;
        }
        $all = $this->getAllType();
        $data = [];
        foreach ($this->type as $key => $item) {
            $data[] = $all[$item];
        }
        return implode(',', $data);
    }



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
     * 当前级别
     * @return string
     */
    public function levelText() {
        $levels = $this->getAllLevel();
        return $levels[$this->level] ?? '';
    }




    /**
     * 获取当前区域网络说明
     * @return string
     */
    public function explainText() {
        if(empty($this->explain)) {
            return null ;
        }
        $all = $this->getAllExplain();
        $data = [];
        foreach ($this->explain as $key => $item) {
            $data[] = $all[$item] ?? '';
        }
        return implode(',', $data);
    }


    /**
     * 服务商
     * @return string|null
     */
    public function operatorText() {
        if(empty($this->operator)) {
            return null;
        }
        $operator = Facilitators::whereIn('id',$this->operator)->pluck('name')->toArray();
        return implode(',', $operator);
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


    public function departments() {
        return $this->hasMany(Department::class, 'area_stand_id');
    }

}
