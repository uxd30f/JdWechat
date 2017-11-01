<?php

namespace App\Http\Controllers\Wechat;

use App\Notes;
use App\Student;
use App\Task;
use App\Wechat;
use EasyWeChat\Message\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageHandlerController extends Controller
{
    /**
     *$message->ToUserName    接收方帐号（该公众号 ID）
     * $message->FromUserName  发送方帐号（OpenID, 代表用户的唯一标识）
     * $message->CreateTime    消息创建时间（时间戳）
     * $message->MsgId         消息 ID（64位整型）
     */


    /**
     * 接管消息处理
     * @param $message
     * @return string
     */
    public static function messageHandler($message){
        switch ($message->MsgType) {
            case 'event':
                return self::eventMessage($message);
                break;
            case 'text':
                // 传个 学号过去可以查看
                $data = [
                    'title' => '绑定用户信息',
                    'description' => '点击后查看详情',
                    'url' => url('bindinfo'),
                    'image' => 'https://avatars2.githubusercontent.com/u/24297454?v=3&u=8b8d3fccf150e53170d9918c7ad02a16e65ec65e&s=400',// ...
                ];

                $news = new News($data);

                return $news;
                return self::textMessage($message);
                break;
            case 'image':
                return self::imageMessage($message);
                break;
            case 'voice':
                return self::voiceMessage($message);
                break;
            case 'video':
                return self::videoMessage($message);
                break;
            case 'location':
                return self::locationMessage($message);
                break;
            case 'link':
                return self::linkMessage($message);
                break;
            // ... 其它消息
            default:
                return self::defaultMessage($message);
                break;
        }
        // ...
    }

    /**
     * 收到事件消息
     * @param $message
     * @return News|string
     */
    private static function eventMessage($message)
    {
        switch ($message->Event)
        {
            // 订阅
            case 'subscribe':
                return self::subscribeEven($message);
                break;

            // 退订
            case 'unsubscribe':
                return '我们还会再见面的';
                break;

            // 扫描带参数二维码事件
            // case 'scancode_push': 触发两次
            case 'SCAN':
                return self::scanEven($message);
                break;

            // 菜单点击
            case 'CLICK':
                return self::clickEven($message);
                break;

            // 其他事件消息
            default:
                return $message->Event;
                break;
        }
    }

    /**
     * 文字消息
     * @param $message
     * @return string
     */
    private static function textMessage($message)
    {
        // 文本消息的内容
        $text = $message->Content;

        return '收到文字消息' .  $text;
    }

    /**
     * 图片消息
     * @param $message
     * @return string
     */
    private static function imageMessage($message)
    {
        // 图片链接
        $image_url = $message->PicUrl;

        return '收到图片消息' . $image_url;
    }

    /**
     * 语音消息
     * @param $message
     * @return string
     */
    private static function voiceMessage($message)
    {
        // 语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
        $id = $message->MediaId;
        // 语音格式，如 amr，speex 等
        $format = $message->Format;
        // 开通语音识别后才有
        $recog = $message->Recognition;

        return '收到语音消息 id = ' . $id . '  格式：' . $format;
    }

    /**
     * 视频消息
     * @param $message
     * @return string
     */
    private static function videoMessage($message)
    {
        // 视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
        $msgid = $message->MediaId;
        // 视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
        $thumb_id = $message->ThumbMediaId;


        return '收到视频消息 id=' . $msgid . '  缩略图 = ' . $thumb_id;
    }

    /**
     * 坐标消息
     * @param $message
     * @return string
     */
    private static function locationMessage($message)
    {
        // 地理位置纬度
        $x = $message->Location_X;
        // 地理位置经度
        $y = $message->Location_Y;
        // 地图缩放大小
        $scale = $message->Scale;
        // 地理位置信息
        $label = $message->Label;

        return '收到坐标消息:' . $label;
    }

    /**
     * 链接消息
     * @param $message
     * @return string
     */
    private static function linkMessage($message)
    {
        // 消息标题
        $title = $message->Title;
        // 消息描述
        $message->Description;
        // 消息链接
        $url = $message->Url;

        return '收到链接消息 : ' . $title;
    }


    /**
     * 其他消息
     * @param $message
     * @return string
     */
    private static function defaultMessage($message)
    {

        return '收到其他消息';
    }

    /**
     * 事件中的订阅消息
     * @return News
     */
    private  static function subscribeEven($message)
    {
        // 用户未关注扫一扫事件  未关注处理一下
        if (isset($message->EventKey))
        {
            // 执行扫一扫事件
            // return self::scanEven($message);
        }

        return "欢迎关注， 可在菜单中绑定信息";
    }

    /**
     * 扫一扫签到事件
     * @param $message
     * @return string
     */
    public static function scanEven($message)
    {
        // 签到时间
        $time = $message->CreateTime;
        // openid
        $openid = $message->FromUserName;

        $student = Student::where('openid', $openid)->first();
        // 还没有绑定
        if ($student == null)
        {
            // 去绑定信息
            return redirect('bindinfo');
        }

        // $key = $message->EventKey;
        $ticket = $message->Ticket;

        // 查询义工事件
        $task = Task::where('ticket', $ticket)->first();

        // 没有这个义工事件
        if ($task == null)
        {
            return "二维码出错";
        }


        // 任务名字
        $task_name = $task->name;
        // 任务 id
        $task_id = $task->id;
        // 用户名字
        $student_name = $student->name;
        // 学生学号
        $student_id = $student->student_id;
		


        // 写入数据库
        $notes = Notes::where('student_id', $student_id)->where('task_id', $task_id)->first();
		
        // 还没有报名
        if ($notes == null)
        {
			// 活动记录  不报名直接签到
            $notes = [
                'student_id' => $student_id,
                'task_id' => $task_id,
                'status' => 1
            ];
            $res = Notes::create($notes);
			$student->work_hour += $task->work_hours;
			$student->save();
        }
		elseif ($notes->status > 0)
		{
			return "SUCCESS";
			// return "你已经签到过了， 请勿重复签到";
		}
        else
        {
			// 报名后签到
            $notes->status = 2;
			$student->work_hour += $task->work_hours;
			$student->save();
			
            $res = $notes->save();
        }

        $is_success = "签到失败";
        if ($res)
        {
            $is_success = "签到成功";
        }

        // 模板消息
        $data = [
            "title"    => [$task_name, '#ff0000'],
            "name"     => [$student_name, "#336699"],
            "status"   => [$is_success, "#00ff00"],
            "time"     => [date('Y-m-d H:i:s', $time), "#5599FF"],
            "remark"   => ['谢谢您的本次帮助' , "#5599FF"],
        ];
        Wechat::blade($data, $openid, 'http://baidu.com');


        // 返回这个 防止微信推送给用户显示该公众号无法提供服务
        return '谢谢参与';
    }

    /**
     * 菜单点击事件
     * @param $message
     */
    private static function clickEven($message)
    {
        switch ($message->EventKey)
        {
            // 查看义工时间事件
            case "C_TIME":
                return self::clickShowTime($message);
                break;
            default:
                break;
        }
    }

    /**
     * 点击菜单中的查看义工事件事件
     * @return News
     */
    private static function clickShowTime($message)
    {
		// 获得 open id
		$openid = $message->FromUserName;
		
		$user = DB::table('t_student')->where('openid', $openid)->first();

		
		if ($user)
		{
			$worktime = $user->work_hour;
		}
		else
		{
			$worktime = 0;			
		}
		

        // 传个 学号过去可以查看
        $data = [
            'title' => '你的义工时间',
            'description' => "你拥有的义工时间是：{$worktime}  工时",
            'url' => 'http://www.gxcme.edu.cn/',
            'image' => $user->headimgurl,// ...
        ];

        $news = new News($data);

        return $news;
    }


}







