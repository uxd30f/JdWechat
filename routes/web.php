<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

ROute::get('test', function(){
	return view('wechat.test');
});

Route::get('/', function () {
    //return view('welcome');
    return redirect('Home');
});
// -------------------------------------新增----------------------------------------//

// 登录后台
route::get('Home', 'Admin\AdminController@Home');
route::get('Login', 'Admin\AdminController@Login');
route::post('CheckLogin', 'Admin\AdminController@CheckLogin');
//操作成功
route::get('success','Admin\AdminController@success');
Route::get('success', ['as'=>'success',function(){
    return view('admin.success');
}]);
// 修改密码
route::get('UpdatePassword', 'Admin\AdminController@UpdatePassword');
route::any('AddAdmin', 'Admin\AdminController@AddAdmin');
route::post('UpdateAdminPassword', 'Admin\AdminController@UpdateAdminPassword');
// 查看所以学生信息
route::get('GetAllStudents', 'Admin\AdminController@GetAllStudents');
//查看所有学生
route::get('ActivityRecord', 'Admin\AdminController@ActivityRecord');
// 签到
route::get('Reg', 'Admin\AdminController@Reg');
// 注销
route::get('exit',function(){
  session(['adminName'=>null]);
  return redirect('Login');
});

//查询学生个人信息
route::get('StudentInfo/{id}','Admin\AdminController@StudentInfo');

route::any('EditStudentInfo','Admin\AdminController@EditStudentInfo');

//帅选任务
route::post('getTasks', 'Admin\AdminController@getTasks');

// -------------------------------------新增结束----------------------------------------//
/**
 * 微信服务器主要路由
 */
Route::group(['namespace' => 'Wechat'], function(){
    Route::any('wechat', 'WechatController@serve');
    // 上传文件
    Route::get('upload', 'WechatController@uploadFile');
    // 获取用户信息
    Route::get('getUserInfo', 'WechatController@getUserInfo');
    // 二维码
    Route::get('qrcode', 'WechatController@qrcode');
    // 菜单
    Route::get('menu', 'WechatController@createMenu');

    // 用户绑定信息成功后添加到数据库
    Route::any('addUser', 'WechatController@addUser');

});


Route::get('view', function(){
    return view('admin.success');
});

/**
 * 后台管理
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    // 后台管理首页
    Route::get('/', function(){
        return view('admin.index');
    });
    // 发布任务页面
    Route::get('releaseTask', 'AdminController@releaseTask');
    // 写入任务到数据库 且 推送消息
    Route::post('createTask', 'AdminController@createTask');

    // 查看所有任务 和二维码
    Route::get('seeQrCode', 'AdminController@seeQrCode');
    // 查看报名人数
    Route::get('sign/{id}', 'AdminController@sign');
    // 查看签到人数
    Route::get('register/{id}', 'AdminController@register');

});

// 网页授权
Route::group(['middleware' => ['wechat.oauth']], function(){
    // 绑定信息视图
    Route::get('bindinfo', 'Wechat\WechatController@bindInfo');

    // 用户报名
    Route::get('admin/signUp', 'Admin\AdminController@signUp');
});
