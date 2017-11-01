<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 't_student';
    protected $primaryKey = "student_id";
    // 不更新时间戳
    public $timestamps = false;

    // 空数组表示允许所有批量赋值
    protected $guarded = [];

    /**
     * 一个学生有多个活动记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Notes', 'student_id');
    }
}
