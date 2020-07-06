<?php


namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

class UserMajor extends Model
{
    protected $fillable = [
        'user_id', 'major_id_one', 'major_level_one', 'major_id_two', 'major_level_two', 'major_id_three', 'major_level_three',
        'skill', 'skill_type', 'skill_level', 'skill_num', 'skill_time'
    ];

}
