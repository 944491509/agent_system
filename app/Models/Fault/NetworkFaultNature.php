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
    protected $fillable = ['area_stand_id','source_id', 'name', 'type'];

    const TYPE_NETWORK = 1;
    const TYPE_MOVE = 2;

    const TYPE_NETWORK_TEXT = '网络故障';
    const TYPE_MOVE_TEXT = '动环故障';

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


    /**
     * 所有的故障类型
     * @return string[]
     */
    public function allType () {
        return [
            self::TYPE_NETWORK => self::TYPE_NETWORK_TEXT,
            self::TYPE_MOVE => self::TYPE_MOVE_TEXT
        ];
    }


    /**
     * 当前故障类型
     * @return string
     */
    public function typeText() {
        $data = $this->allType();
        return $data[$this->type] ?? '';
    }

}
