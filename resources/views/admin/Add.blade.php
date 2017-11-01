<link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
<script src="{{asset('themes/desktop/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/layui/lay/dest/layui.all.js')}}"></script>
<div style="width: 50%;margin: 60px auto;">
    <form class="layui-form" action="" method="post">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="name" placeholder="建议使用姓名" autocomplete="off" class="layui-input adminPassword1">
                <input type="hidden" name="juri" value="1">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="text" name="pwd" placeholder="请输入密码" autocomplete="off" class="layui-input adminPassword2">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn UpdateAdminPassword">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <span id="passstrength" style="display: inline;margin-left: 10%;font-size: 15px;"></span>
                @if(session()->has('msg'))
                <span id="passstrength" style="display: inline;margin-left: 10%;font-size: 15px;">
                    {{session('msg')}}
                </span>
                @endif
            </div>
        </div>
    </form>
</div>
<div>
<table class="layui-table">
  <colgroup>
    <col width="200">
    <col width="200">
  </colgroup>
  <thead>
    <tr>
      <th>用户名</th>
      <th>身份</th>
    </tr> 
  </thead>
  <tbody>
   @forelse($list as $item)
    <tr>
      <td>{{$item['name']}}</td>
      <td>普通管理员</td>
    </tr>
   @empty
    <tr>
      <td colspan="2">暂无用户</td>
    </tr>
   @endforelse
  </tbody>
</table>
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
            $(this).text('添加中...');
            return true;
        });
    });

    function GetMsg(o, msg) {
        o.html('<strong style="color: red;">' + msg + '</strong>');
        setTimeout(function () {
            o.html('');
        }, 3000);
    }
</script>
