<?php

namespace App\Models\Fault;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $source_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class NetworkFaultNature extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['source_id', 'name'];


    /**
     * 时限
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function times() {
        return $this->hasMany(NetworkFaultTime::class, 'nature_id');
    }


    /**
     * 故障来源
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source() {
        return $this->belongsTo(NetworkFaultSource::class, 'source_id');
    }

}
