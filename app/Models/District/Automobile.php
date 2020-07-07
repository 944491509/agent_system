<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

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
        'car_owner', 'price', 'oil_wear', 'engine_num', 'vin', 'loads', 'city_id', 'stand_id',
        'user_id', 'nature', 'use', 'bought_at', 'created_at', 'updated_at'
    ];

    const PASSENGER_CAR = 1;
    const SEDAN_CAR = 2;
    const VAN = 3;

    const PASSENGER_CAR_TEXT = "小型普通客车";
    const SEDAN_CAR_TEXT = "小型轿车";
    const VAN_TEXT = "小型客货两用车";


    public function allCatType() {
        return [
            self::PASSENGER_CAR => self::PASSENGER_CAR_TEXT,
            self::SEDAN_CAR => self::SEDAN_CAR_TEXT,
            self::VAN => self::VAN_TEXT
        ];
    }



}
