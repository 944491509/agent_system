<?php

namespace App\Models\District;

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
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['area_stand_id', 'name', 'model', 'number', 'unit', 'factory', 'created_at', 'updated_at'];

}
