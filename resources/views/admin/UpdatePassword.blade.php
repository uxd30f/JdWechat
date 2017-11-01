<link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
<script src="{{asset('themes/desktop/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/layui/lay/dest/layui.all.js')}}"></script>
<div style="width: 50%;margin: 60px auto;">
    <form class="layui-form" action="JavaScript:;" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" placeholder="请输入密码" autocomplete="off" class="layui-input adminPassword1">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
                <input type="password" placeholder="请确认密码" autocomplete="off" class="layui-input adminPassword2">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn UpdateAdminPassword">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <span id="passstrength" style="display: inline;margin-left: 10%;font-size: 15px;"></span>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        $('.UpdateAdminPassword').click(function () {
            $adminPassword1 = $('.adminPassword1').val();
            $adminPassword2 = $('.adminPassword2').val();
            $oMsg = $('#passstrength');
            if ($adminPassword1 == '' || $adminPassword2 == '') {
                GetMsg($oMsg, '不能有空值');
                return false;
            }
            if ($('.adminPassword1').val().length < 8) {
                GetMsg($oMsg, '密码不能小于8位');
                return false;
            }
            if ($adminPassword1 != $adminPassword2) {
                GetMsg($oMsg, '两次密码不一致');
                return false;
            }
            $.post('UpdateAdminPassword',{pwd:$adminPassword1,'_token':'{{csrf_token()}}'},function (condition) {
                if (condition=='ok') {
                  $('.adminPassword1').val('');
                  $('.adminPassword2').val('');
                      GetMsg($oMsg, '修改成功');
                }else{
                      GetMsg($oMsg, condition);
                }
            });
        });
    });
    function GetMsg(o, msg) {
        o.html('<strong style="color: red;">' + msg + '</strong>');
        setTimeout(function() {
            o.html('');
        },3000);
    }
</script>
