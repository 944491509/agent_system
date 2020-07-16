<?php

namespace App\Models\Fault;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $nature_id
 * @property boolean $hour
 * @property string $created_at
 * @property string $updated_at
 */
class NetworkFaultTime extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nature_id', 'hour'];

    /**
     * 故障性质
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nature() {
        return $this->belongsTo(NetworkFaultNature::class, 'nature_id');
    }

}
