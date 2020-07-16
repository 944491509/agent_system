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
    protected $table = 'trouble_datas';

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

    // 状态
    const STATUS_1 = 1; // 暂存
    const STATUS_2 = 2; // 提交


    // 影响等级
    const IMPACT_LEVEL_1 = 1;
    const IMPACT_LEVEL_2 = 2;
    const IMPACT_LEVEL_3 = 3;
    const IMPACT_LEVEL_4 = 4;

    const IMPACT_LEVEL_TEXT_1 = '特别重大影响';
    const IMPACT_LEVEL_TEXT_2 = '重大影响';
    const IMPACT_LEVEL_TEXT_3 = '较大影响';
    const IMPACT_LEVEL_TEXT_4 = '一般影响';

    // 处理等级
    const DEAL_WITH_1 = 1;
    const DEAL_WITH_2 = 2;
    const DEAL_WITH_3 = 3;

    const DEAL_WITH_TEXT_1 = '特急';
    const DEAL_WITH_TEXT_2 = '紧急';
    const DEAL_WITH_TEXT_3 = '一般';

    // 建议处理方式
    const SUGGEST_1 = 1;
    const SUGGEST_2 = 2;
    const SUGGEST_3 = 3;
    const SUGGEST_4 = 4;

    const SUGGEST_TEXT_1 = '暂无建议';
    const SUGGEST_TEXT_2 = '排水';
    const SUGGEST_TEXT_3 = '自行维护整改';
    const SUGGEST_TEXT_4 = '维修签证';

    public static function getAllImpactLevel()
    {
        return [
            self::IMPACT_LEVEL_1 => self::IMPACT_LEVEL_TEXT_1,
            self::IMPACT_LEVEL_2 => self::IMPACT_LEVEL_TEXT_2,
            self::IMPACT_LEVEL_3 => self::IMPACT_LEVEL_TEXT_3,
            self::IMPACT_LEVEL_4 => self::IMPACT_LEVEL_TEXT_4,
        ];
    }

    public static function getAllDealWith()
    {
        return [
            self::DEAL_WITH_1 => self::DEAL_WITH_TEXT_1,
            self::DEAL_WITH_2 => self::DEAL_WITH_TEXT_2,
            self::DEAL_WITH_3 => self::DEAL_WITH_TEXT_3,
        ];
    }

    public static function getAllSuggest()
    {
        return [
            self::SUGGEST_1 => self::SUGGEST_TEXT_1,
            self::SUGGEST_2 => self::SUGGEST_TEXT_2,
            self::SUGGEST_3 => self::SUGGEST_TEXT_3,
            self::SUGGEST_4 => self::SUGGEST_TEXT_4,
        ];
    }


}
