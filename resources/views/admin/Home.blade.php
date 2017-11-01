<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/desktop/style/desktop.css?t')}}">
    <meta name="baidu-site-verification" content="btBYeQVH5L"/>
</head>
<body class="desktop-bg">
<div class="" id="loading" style="position: absolute; top: 49%; left: 50%; margin-left: -73px; display:block;"><i
            class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">ဂ</i></div>
<!--桌面app配置参数-->
<script type="text/javascript" src="{{asset('themes/desktop/js/desktop.data.js')}}"></script>
<!--主桌面-->

<div class="swiper-container desktop-container small-click" data-type="hidemenu">
    <div class="swiper-pagination"></div>
    <div class="swiper-wrapper">
    </div>
</div>
<!--任务栏-->
<div class="desktop-taskbar">
    <!--div class="desktop-taskbar-pr"></div-->
    <div id="opening-menu" class="opening-menu">
        <div class="opening-menu-app-list"></div>
        <div class="opening-menu-user">
            <div class="desktop-opening-icon"></div>
            <div class="opening-menu-user-list">
                <a title="系统设置" data-type="setting" class="dock_tool_setting small-click"
                   href="javascript:void(0)">系统设置</a>
                <a title="主题设置" data-type="theme" class="dock_tool_theme small-click" href="javascript:void(0)">主题设置</a>
                <a title="个人资料" data-type="users" class="dock_tool_ziliao small-click"
                   href="javascript:void(0)">个人资料</a>
                <a title="注销登录" data-type="loginout" class="dock_tool_loginout small-click" href="{{url('exit')}}">注销登录</a>
            </div>
        </div>
    </div>
    <!--开始菜单-->
    <div class="layui-inline taskbar-win small-click" data-type="openingmenu">
        <i class="iconfont icon-windows">&#xe75e;</i>
    </div>
    <!---->
    <div class="layui-inline desktop-taskbar-app-list">

    </div>
    <!--时间显示-->
    <div class="layui-inline taskbar-time">
        <label id="laydate-hs"></label>
        <label id="laydate-ymd"></label>
    </div>
    <div class="layui-inline taskbar-showdesktop small-click" data-type="showdesktop" title="显示桌面"></div>
</div>
<!--右键菜单-->
<div class="desktop-menu">
    <ul>
        <li><a href="javascript:;" class="small-click" data-type="launchFullscreen">进入全屏</a></li>
        <hr/>
        <li><a href="javascript:;" class="small-click" data-type="showdesktop">显示桌面</a></li>
        <li><a href="javascript:;" class="small-click" data-type="closeall">关闭所有</a></li>
        <hr/>
        <li><a href="javascript:;" class="small-click" data-type="setting">系统设置</a></li>
        <hr/>
        <li><a href="{{url('exit')}}" class="small-click" data-type="loginout">注销</a></li>
    </ul>
</div>
</body>
<script src="{{asset('themes/layui/lay/dest/layui.all.js')}}"></script>
<script src="{{asset('themes/desktop/js/swiper.js')}}"></script>
<script src="{{asset('themes/desktop/js/desktop.js')}}"></script>
<script>
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?f8df255dfb46b5e00186a537e73370d1";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();

</script>
</body>
</html>
