<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
    protected $table = 't_notes';
    // 不更新时间戳
    public $timestamps = false;

    // 空数组表示允许所有批量赋值
    protected $guarded = [];




    /**
     * 一条记录一个学生
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }



    /**
     * 一条记录一个活动
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
