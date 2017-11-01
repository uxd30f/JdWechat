<link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
<script src="{{asset('themes/desktop/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/layui/layui.js')}}"></script>
<link rel="stylesheet" href="{{asset('layer/skin/default/layer.css')}}">
<script src="{{asset('layer/layer.js')}}"></script>
<form class="layui-form" action="javascript:;" style="width: 96%;margin: 20px auto;">
    <div class="layui-form-item">
        <label class="layui-form-label">学号</label>
        <div class="layui-input-block">
            <input type="text" name="title" placeholder="请输入学号" autocomplete="off" class="layui-input s_number"
                   value="{{$student['student_id']}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-block">
            <input type="text" name="title" placeholder="请输入姓名" autocomplete="off" class="layui-input s_name"
                   value="{{$student['name']}}">

        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn editInfoBtn" lay-submit lay-filter="formDemo">立即修改</button>
        </div>
    </div>
</form>

<script>

    $(function () {
        $('.editInfoBtn').click(function () {
            var num = $('.s_number').val();
            var name = $('.s_name').val();
            if (num.length == 0 || name.length == 0) {
                layer.msg('不能有空值', {icon: 0});
            }
            else {
                $.post('{{url("EditStudentInfo")}}', {
                    name: name,
                    num: num,
                    id: '{{$id}}',
                    '_token': '{{csrf_token()}}'
                }, function (data) {
                    if (data == 'ok') {
                        layer.msg('修改成功', {icon: 1});
                    } else {
                        layer.msg(data, {icon: 5});
                    }
                })
            }
        });
    })

</script>


