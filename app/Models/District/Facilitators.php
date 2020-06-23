<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;

class Facilitators extends Model
{
    //
    protected $fillable = [
        'name', 'status'
    ];

    public $hidden = ['updated_at'];

    const HIDE = 0; // 隐藏
    const SHOW = 1; // 显示

    const HIDE_TEXT = '隐藏';
    const SHOW_TEXT = '显示';


    /**
     * 全部状态
     * @return string[]
     */
    public function getAllStatus() {
        return [
            self::HIDE => self::HIDE_TEXT,
            self::SHOW => self::SHOW_TEXT,
        ];
    }

    /**
     * 当前状态
     * @return string
     */
    public function statusText() {
        $status = $this->getAllStatus();
        return $status[$this->status] ?? '';
    }

}
