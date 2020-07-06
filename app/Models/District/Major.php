<?php


namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}
