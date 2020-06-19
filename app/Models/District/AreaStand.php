<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

class AreaStand extends Model
{


    /**
     * @var array
     */
    protected $fillable = [
        'id', 'city_id', 'district_id', 'name', 'operator', 'explain', 'remark'
    ];
}
