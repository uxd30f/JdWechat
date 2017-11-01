<!DOCTYPE html>
<!-- saved from url=(0032)http://wechat.shiguopeng.cn/test -->
<html class="ui-mobile">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="{{asset('./phone/jquery.mobile-1.3.2.min.css')}}">
    <title>绑定信息</title></head>

  <body class="ui-mobile-viewport ui-overlay-c">
    <div data-role="page" data-url="/test" tabindex="0" class="ui-page ui-body-c ui-page-active" style="min-height: 637px;">
    <h1>绑定信息</h1>
    <h2>请务必谨慎填写，错了将不可修改</h2>
    <form action="{{ url('addUser') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="openid" value="{{ $user['openid'] }}">
        <input type="hidden" name="nickname" value="{{ $user['nickname'] }}">
        <input type="hidden" name="sex" value="{{ $user['sex'] }}">
        <input type="hidden" name="headimgurl" value="{{ $user['headimgurl'] }}">
 <div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-c">
          <input type="text" name="student_id" id="" placeholder="请输入学号" class="ui-input-text ui-body-c"></div>
        <div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-c">
          <input type="text" name="name" id="" placeholder="请输入姓名" class="ui-input-text ui-body-c"></div>
        <div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" data-disabled="false" class="ui-submit ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all" aria-disabled="false">
          <span class="ui-btn-inner">
            <span class="ui-btn-text">确认绑定</span></span>
          <input type="submit" value="确认绑定" class="ui-btn-hidden" data-disabled="false"></div>
      </form>
    </div>

  </body>

</html>