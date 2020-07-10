<?php

namespace App\Models\District;

use App\Models\District\InstrumentImage;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $area_stand_id
 * @property string $name
 * @property string $model
 * @property int $number
 * @property string $unit
 * @property string $factory
 * @property string $created_at
 * @property string $updated_at
 */
class Instrument extends Model
{
    const PURCHASE = 0; // 自购
    const LEASE = 1;   // 租聘
    const TAKEOVER = 2;  // 原单位收购

    const PURCHASE_TEXT = '自购';
    const LEASE_TEXT = '租聘';
    const TAKEOVER_TEXT = '原单位收购';

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
        'area_stand_id', 'name', 'model', 'number', 'unit', 'factory',
        'serial_number', 'attributes', 'purchase_time', 'money', 'tag',
        'created_at', 'updated_at'
    ];


    public function areaStand()
    {
        return $this->belongsTo(AreaStand::class);
    }

    public function images()
    {
        return $this->hasMany(InstrumentImage::class);
    }

    public static function buyAttribute()
    {
        return [
            self::PURCHASE => self::PURCHASE_TEXT,
            self::LEASE => self::PURCHASE_TEXT,
            self::TAKEOVER => self::TAKEOVER_TEXT
        ];
    }

}
