<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ChinaArea extends Model
{
    const CHINA = 1;

    public $hidden = [
        'created_at', 'updated_at'
    ];
}
