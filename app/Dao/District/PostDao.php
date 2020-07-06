<?php


namespace App\Dao\District;


use App\Models\District\Post;

class PostDao
{
    /**
     * 获取所有岗位
     * @return mixed
     */
    public function getAllPost()
    {
        return Post::all();
    }
}
