<?php

namespace App;

use EasyWeChat\Message\News;
use Illuminate\Database\Eloquent\Model;
use Org\Util\Date;
use Psy\Exception\ErrorException;

class Wechat extends Model
{
    // 获取用户信息
    public static function getUserInfo($openId)
    {
        $wechat = app('wechat');
        $userService = $wechat->user;

        // 批量获取
        $userinfo = "";
        if (is_array($openId)) {
            $userinfo = $userService->batchGet($openId);
        } elseif (is_string($openId)) // 获取单个用户
        {
            $userinfo = $userService->get($openId);
        } else {
            $userinfo = null;
        }

        return $userinfo;
    }
    /**
     * 模板消息
     */
    public static function blade($data, $openid, $url, $template_id = "")
    {
        $wechat = app('wechat');
        $notice = $wechat->notice;

        // 发送
        $messageId = $notice->send([
            'touser' => $openid,
            'template_id' => '38N9mtdpJZvgRj1CtEk5xahFJ2t7FwPNu3s307koHuk',
            'url' => $url,
            'data' => $data,
        ]);
    }

    /**
     * 生成二维码
     * @param int $id
     * @param int $time
     */
    public static function qrcode($id = 9, $time = (6 * 24 * 3600))
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

        return $ticket;
    }


    /**
     * 群发消息
     */
    public static function sendMessage($title, $time, $url)
    {
        $wechat = app('wechat');
        $broadcast = $wechat->broadcast;
        $res = $broadcast->sendText("\n【新任务】\n \n 任务名称：\n\n {$title} \n\n 将于 {$time} 开始。 \n\n  <a href='{$url}'>立即报名</a> \n");
        if ($res['errcode'] == '0') {
            return true;
        } else {
            return false;
        }
    }
}
