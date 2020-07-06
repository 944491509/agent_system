<?php

namespace App\Models\District;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const GENDER_MAN = 1;
    const GENDER_WOMAN = 2;

    protected $fillable = [
        'name', 'email', 'gender', 'mobile', 'phone', 'group_cornet', 'type'
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function userMajor()
    {
        return $this->hasMany(UserMajor::class, 'user_id', 'id');
    }
}
