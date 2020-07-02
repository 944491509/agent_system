<?php
namespace App\Models\InitialValue;

use Illuminate\Database\Eloquent\Model;

class ProfessionalSkill extends Model
{

    protected $fillable = [ 'name' ];


    /**
     * 专业等级
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes() {
        return $this->hasMany(ProfessionalClass::class, 'skill_id');
    }


}
