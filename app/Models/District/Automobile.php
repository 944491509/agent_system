<?php

namespace App\Models\District;

use App\Models\ChinaArea;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

/**
 * @property int $id
 * @property string $number
 * @property string $explain
 * @property boolean $type
 * @property string $manufacturers
 * @property string $model
 * @property string $displacement
 * @property string $bought_company
 * @property string $car_owner
 * @property float $price
 * @property string $oil_wear
 * @property string $engine_num
 * @property string $vin
 * @property string $load
 * @property int $city_id
 * @property int $stand_id
 * @property int $user_id
 * @property boolean $nature
 * @property boolean $use
 * @property string $bought_at
 * @property string $created_at
 * @property string $updated_at
 */
class Automobile extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'number', 'explain', 'type', 'manufacturers', 'model', 'displacement', 'bought_company',
        'car_owner', 'price', 'oil_wear', 'engine_num', 'vin', 'loads', 'stand_id', 'user_id',
        'nature', 'use', 'bought_at', 'created_at', 'updated_at'
    ];

    // 车辆类型
    const PASSENGER_CAR = 1;
    const SEDAN_CAR = 2;
    const VAN = 3;
    const PASSENGER_CAR_TEXT = "皮卡";
    const SEDAN_CAR_TEXT = "小型轿车";
    const VAN_TEXT = "面包车";

    // 车辆性质
    const ONESELF = 1; // 自有
    const LEASE = 2; // 租赁
    const ONESELF_TEXT = '自有';
    const LEASE_TEXT = '租赁';

    // 车辆用途
    const MAINTAIN = 1;
    const PROJECT = 2;
    const GENERATE_ELECTRICITY = 3;
    const MAINTAIN_TEXT = '维护';
    const PROJECT_TEXT = '工程';
    const GENERATE_ELECTRICITY_TEXT = '发电';


    /**
     * 车辆类别
     * @return string[]
     */
    public function allCatType() {
        return [
            self::PASSENGER_CAR => self::PASSENGER_CAR_TEXT,
            self::SEDAN_CAR => self::SEDAN_CAR_TEXT,
            self::VAN => self::VAN_TEXT
        ];
    }


    /**
     * 当前车辆类别
     * @return string
     */
    public function typeText() {
        $types = $this->allCatType();
        return $types[$this->type] ?? '';
    }


    /**
     * 车辆性质
     * @return string[]
     */
    public function allNature() {
        return [
            self::ONESELF => self::ONESELF_TEXT,
            self::LEASE => self::LEASE_TEXT
        ];
    }


    /**
     * 当前车辆性质
     * @return string
     */
    public function natureText() {
        $natures = $this->allNature();
        return $natures[$this->nature] ?? '';
    }


    /**
     * 车辆用途
     * @return string[]
     */
    public function allUse() {
        return [
            self::MAINTAIN => self::MAINTAIN_TEXT,
            self::PROJECT => self::PROJECT_TEXT,
            self::GENERATE_ELECTRICITY => self::GENERATE_ELECTRICITY_TEXT,
        ];
    }


    /**
     * 当前车辆用途
     * @return string
     */
    public function useText() {
        $uses = $this->allUse();
        return $uses[$this->use] ?? '';
    }


    /**
     * 项目部
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stand() {
        return $this->belongsTo(AreaStand::class, 'stand_id');
    }


    /**
     * 驾驶员
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver() {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function images() {
        return $this->hasMany(AutomobileImage::class, 'automobile_id');
    }



}
