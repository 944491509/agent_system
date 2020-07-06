<?php


namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'number', 'address', 'id_number', 'birthday', 'area_stand_id', 'department_id', 'group_id', 'post_id',
        'major_id', 'entry_time', 'signing_time', 'departure_time', 'due_time', 'serial', 'certificate',
        'accommodation', 'dormitory_num', 'card_num', 'card_time', 'is_insurance', 'insurance_company', 'insurance_time',
        'pay_card', 'vehicle_card', 'get_vehicle_card_time', 'vehicle_model', 'vehicle_card_num', 'vehicle_card_audit_time',
        'next_vehicle_card_audit_time', 'id_card_time', 'status', 'note'
    ];

    /**
     * 用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 项目部
     */
    public function areaStand()
    {
        return $this->belongsTo(AreaStand::class);
    }

    /**
     * 部门
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * 班组
     */
    public function group()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    /**
     * 专业
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * 岗位
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * 单选 是否
     * @return string[]
     */
    public static function whether()
    {
        return [1 => '是', 0 => '否'];
    }

    public static function getAllEducation()
    {
        return [
            '小学',
            '初中',
            '高中',
            '专科',
            '本科',
            '硕士',
            '博士'
        ];
    }
}
