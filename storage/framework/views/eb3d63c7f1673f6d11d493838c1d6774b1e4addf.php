<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/login2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('layer/skin/default/layer.css')); ?>">
</head>
<body>
<div class="login" style="margin-top:250px;">
    <div class="header" style="line-height:51px;text-align:center;font-size:16px;">
        管理员登录
    </div>
    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 235px;">
        <!--登录-->
        <div class="web_login" id="web_login">
            <div class="login-box">
                <div class="login_form">
                    <form action="CheckLogin" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm"
                          method="post">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                        <div class="uinArea" id="uinArea">
                            <label class="input-tips" for="u">帐号：</label>
                            <div class="inputOuter" id="uArea">
                                <input type="text" id="u" name="name" class="inputstyle name" placeholder="请输入用户名"/>
                            </div>
                        </div>
                        <div class="pwdArea" id="pwdArea">
                            <label class="input-tips" for="p">密码：</label>
                            <div class="inputOuter" id="pArea">
                                <input type="password" id="p" name="pwd" class="inputstyle pwd"/ placeholder="请输入密码">
                            </div>
                        </div>
                        <div style="padding-left:50px;margin-top:20px;">
                            <input type="button" value="登 录" style="width:200px;margin-left:5px;" class="button_blue"/>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <!--登录end-->
    </div>
</div>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('layer/layer.js')); ?>"></script>
<script type="text/javascript">
    $(function () {
        $('.button_blue').click(function () {
            login();
        });
		
		$('#p').keydown(function(e){ 
			if(e.keyCode==13){
				login();
			}
		});
    });
	
	
	function login()
	{
		var name = $.trim($('.name').val());
            var pwd = $.trim($('.pwd').val());
            if (name.length == 0 || pwd.length == 0) {
                layer.msg('请正确输入登录信息', {icon: 5});
                return false;
            }
            $.post('CheckLogin', {name: name, pwd: pwd, "_token": "<?php echo e(csrf_token()); ?>"}, function (data) {
                if (data == 'ok') {
                    location.href = 'Home';
                } else {
                    layer.msg(data, {icon: 5});
                }
            })
	}
</script>
</body>
</html>
