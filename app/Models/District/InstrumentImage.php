<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $instrument_id
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 */
class InstrumentImage extends Model
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
    protected $fillable = ['instrument_id', 'path', 'created_at', 'updated_at'];

}
