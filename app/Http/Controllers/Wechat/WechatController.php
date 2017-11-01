<?php

namespace App\Http\Controllers\Wechat;

use App\Student;
use EasyWeChat\Message\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * 处理微信消息
     * @return mixed
     */
    public function serve()
    {
        $wechat = app('wechat');
        // 从项目实例中得到服务端应用实例。
        $server = $wechat->server;

        $server->setMessageHandler('App\Http\Controllers\Wechat\MessageHandlerController::messageHandler');

        // 响应消息
        return $wechat->server->serve();
    }


    /**
     * 获取用户信息
     */
    public function getUserInfo()
    {
        $wechat = app('wechat');
        $userService = $wechat->user;

        $users = $userService->lists();

        dd($users);
    }

    /**
     * 上传文件
     */
    public function uploadFile()
    {


        // pic_media_id


        $wechat = app('wechat');
        // 永久素材
        $material = $wechat->material;
        $result = $material->uploadImage(storage_path('wechat/1.png'));  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）！
        var_dump($result);
    }

    /**
     * 生成二维码
     */
    public function qrcode($id = 9, $time = (6 * 24 * 3600))
    {
        $wechat = app('wechat');
        $qrcode = $wechat->qrcode;

        // 9  是签到事件
        $result = $qrcode->temporary($id, $time);
        $ticket = $result->ticket;                      // 或者 $result['ticket']

        $expireSeconds = $result->expire_seconds; // 有效秒数
        // $url = $result->url; // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片


        // 得到url
        $url = $qrcode->url($ticket);
        $content = file_get_contents($url); // 得到二进制图片内容
        file_put_contents(storage_path('wechat/qrcode.png'), $content); // 写入文件
        echo "请扫一扫二维码签到";

        // 获取二维码的标签
        echo $ticket;
        echo '<img src="' . $url . '">';
    }

    /**
     * 摇一摇功能
     */
    public function yaoyiyao()
    {
        $options = Wechat::getConfig();
        $app = new Application($options);
        $access_token = $app->access_token;

        $url = 'https://api.weixin.qq.com/shakearound/user/getshakeinfo?access_token=' . $access_token;


    }

    /**
     * 创建菜单接口
     * @param Request $request
     */
    public function createMenu(Request $request)
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        if ($request->has('show')) {
            $res = $menu->all();
        } elseif ($request->has('delete')) {
            $res = $menu->destroy(); // 全部
        } else {
            $buttons = [
                [
                    "type" => "view",
                    "name" => "系部网站",
                    "url" => 'http://www.gxcme.edu.cn/x/jisuanji/',
                ],
                [
                    "name" => "个人信息",
                    "sub_button" => [
                        [
                            "type" => "click",
                            "name" => "义工时间",
                            "key" => "C_TIME"
                        ],
                        [
                            "type" => "view",
                            "name" => "绑定信息",
                            "url" => url('bindinfo'),
                        ],
                    ],
                ],
                [
                    "name" => "签到",
                    "type" => "scancode_push",
                    "key" => "S_SCAN",
                ],
            ];
            $res = $menu->add($buttons);
        }

		return view('admin.success', ['msg' => '创建成功']);
    }
//"sub_button" => [
//[
//"type" => "scancode_push",
//"name" => "扫一扫",
//"key"  => "S_SCAN",
//],
//[
//"type" => "location_select",
//"name" => "我的位置",
//"key" => "SCAN_3",
//"sub_button" => [ ],
//],
//],
    /**
     * 绑定信息 视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindInfo()
    {

        $user = session("wechat.oauth_user"); // 拿到授权用户资料
		
        if (!$user) {
            return view('admin.error', ['msg' => '服务器异常 错误号：-1']);
        }

        $user = $user['original'];

        return view('wechat.bindinfo', ['user' => $user]);
    }


    /**
     * 注册用户到数据库
     * @param Request $request
     * @return string
     */
    public function addUser(Request $request)
    {
		
		 $this->validate($request, [
			'name' => 'required',
			'phone' => 'required|size:11',
			'student_id' => 'required|size:11',
		], [
			'name.required' => '姓名不能为空',
			'phone.required' => '手机号不能为空',
			'phone.size' => '手机号必须为11位',
			'student_id.required' => '学号不能为空',
			'student_id.size' => '学号必须为11位',
		]);
		
        // 获取请求参数
        $info = $request->except('_token');
        // 获取学号查看是否已经有此用户
        $info['student_id'] = intval($info['student_id']);

        $res = Student::find($info['student_id']);
		$openid_unique = Student::where('openid', $info['openid'])->first();

        // 用户已经存在
        if (!is_null($res)) {
            return view('admin.error', ['msg' => '此学号已经绑定账号了']);
        }
		// oepnid 已经存在
		if (!is_null($openid_unique)) {
			 return view('admin.error', ['msg' => '此账号已经绑定账号了, 要修改信息请联系管理员']);
		}

		
        $res = Student::create($info);

        if ($res) {
			return view('admin.success', ['msg' => '绑定成功']);
        }
		else
		{
			return view('admin.error', ['msg' => '绑定失败， 请联系管理员~']);
		}

    }

}
