<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 't_task';
    // 不更新时间戳
    public $timestamps = false;
    // 外键

    // 空数组表示允许所有批量赋值
    protected $guarded = [];

    /**
     * 一个活动多条记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Notes');
    }

}
