<?php


namespace App\Models\InitialValue;

use Illuminate\Database\Eloquent\Model;

class ProfessionalClass extends Model
{
    protected $fillable = ['skill_id', 'name'];


    /**
     * 专业技能
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skill () {
        return $this->belongsTo(ProfessionalSkill::class, 'skill_id');
    }

}
