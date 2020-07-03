<?php


namespace App\Models\District;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'stand_id', 'department_id', 'name', 'explain', 'require', 'level', 'belong_to'
    ];

    public $casts = [
        'belong_to' => 'array',
    ];

    const MANAGE = 1;
    const MOBILE_NETWORK = 2;
    const FIXED_NETWORK = 3;


    const MANAGE_TEXT = '管理';
    const MOBILE_NETWORK_TEXT = '移网';
    const FIXED_NETWORK_TEXT = '固网';


    /**
     * 所以的岗位
     * @return string[]
     */
    public function getAllBelongTo() {
        return [
            self::MANAGE => self::MANAGE_TEXT,
            self::MOBILE_NETWORK => self::MOBILE_NETWORK_TEXT,
            self::FIXED_NETWORK => self::FIXED_NETWORK_TEXT,
        ];
    }


    /**
     * 项目部
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function areaStand() {
        return $this->belongsTo(AreaStand::class, 'stand_id');
    }

    /**
     * 部门
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }


    public function belongToText() {
        if(is_null($this->belong_to)) {
            return null;
        }
        $belongTos = $this->getAllBelongTo();
        $data = [];
        foreach ($this->belong_to as $key => $item) {
            $data[] = $belongTos[$item];
        }
        return implode(',', $data);
    }



}
