<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 't_admin';
    // 不更新时间戳
    public $timestamps = false;

    // 空数组表示允许所有批量赋值
    protected $guarded = [];

}
