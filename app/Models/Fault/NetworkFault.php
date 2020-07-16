<?php

namespace App\Models\Fault;

use App\Models\District\AreaStand;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $area_stand_id
 * @property int $source_id
 * @property int $nature_id
 * @property int $time_id
 * @property boolean $kind
 * @property boolean $type
 * @property int $station_id
 * @property string $happen_time
 * @property string $accept_time
 * @property string $business
 * @property string $message
 */
class NetworkFault extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'area_stand_id', 'source_id', 'nature_id', 'time_id', 'kind', 'type', 'station_id',
        'happen_time', 'accept_time', 'business', 'message'];

    const TYPE_NETWORK = 1;
    const TYPE_MOVE = 2;

    const TYPE_NETWORK_TEXT = '网络故障';
    const TYPE_MOVE_TEXT = '动环故障';


    const KIND_1 = '基站(室分)';
    const KIND_2 = '接入网';
    const KIND_3 = '线路';

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


    /**
     * 故障种类
     * @return string[]
     */
    public function allKind() {
        return [
            self::KIND_1,
            self::KIND_2,
            self::KIND_3
        ];
    }

    /**
     * 当前故障种类
     * @return string
     */
    public function kindText() {
        $kinds = $this->allKind();
        return $kinds[$this->kind]??'';
    }


    /**
     * 项目部
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stand() {
        return $this->belongsTo(AreaStand::class, 'area_stand_id');
    }


    /**
     * 来源
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source() {
        return $this->belongsTo(NetworkFaultSource::class, 'source_id');
    }


    /**
     * 性质
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nature() {
        return $this->belongsTo(NetworkFaultNature::class, 'nature_id');
    }


    /**
     * 时限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function time() {
        return $this->belongsTo(NetworkFaultTime::class, 'time_id');
    }
}
