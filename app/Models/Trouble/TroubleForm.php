<?php

namespace App\Models\Trouble;

use App\Models\District\AreaStand;
use App\Models\District\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $area_stand_id
 * @property int $user_id
 * @property int $network_type
 * @property int $category
 * @property int $network_name
 * @property string $name
 * @property string $position
 * @property string $distance
 * @property string $reason
 * @property string $unit
 * @property string $person
 * @property string $mobile
 * @property boolean $influence
 * @property boolean $deal_with
 * @property boolean $suggest
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 */
class TroubleForm extends Model
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
    protected $fillable = [
        'area_stand_id', 'user_id', 'network_type', 'category', 'network_name', 'name', 'position',
        'distance', 'reason', 'unit', 'person', 'mobile', 'influence', 'deal_with', 'suggest', 'status',
        'created_at', 'updated_at'
    ];

    public function stand()
    {
        return $this->belongsTo(AreaStand::class, 'area_stand_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(TroubleData::class, 'network_type');
    }

    public function network_category()
    {
        return $this->belongsTo(TroubleData::class, 'category');
    }

    public function network()
    {
        return $this->belongsTo(TroubleData::class, 'network_name');
    }


}
