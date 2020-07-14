<?php

namespace App\Models\Trouble;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $p_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class TroubleData extends Model
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
    protected $fillable = ['p_id', 'name', 'created_at', 'updated_at'];

}
