<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{

    protected $fillable = [
        'stand_id' , 'department_id', 'name'
    ];


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
}
