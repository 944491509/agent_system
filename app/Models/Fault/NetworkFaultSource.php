<?php

namespace App\Models\Fault;

use App\Models\District\AreaStand;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $area_stand_id
 * @property string $created_at
 * @property string $updated_at
 */
class NetworkFaultSource extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'area_stand_id'];


    /**
     * 项目部
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stand() {
        return $this->belongsTo(AreaStand::class, 'area_stand_id');
    }

}
