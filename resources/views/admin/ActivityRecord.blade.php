<link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
<script src="{{asset('themes/desktop/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/layui/layui.js')}}"></script>
<div style="width: 96%;margin: 0 auto;margin-top: 30px;">
    <form class="layui-form" action="" name="formName">
        <div class="layui-form-item">
            <label class="layui-form-label">请选择任务</label>
            <div class="layui-input-block">
                <select name="">
                    <option value="0">全部</option>
                    @foreach($stasks as $val)
                        <option value="{{$val['id']}}">{{$val['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>
<script>
    layui.use('form', function () {
        var form = layui.form();
        form.on('select', function (data) {
            var str = '';
            $.post('getTasks', {id: data.value, '_token': '{{csrf_token()}}'}, function (data) {
                $('#tasks').html('');
                for (var i in data) {
                    if (data[i].status == '0') {
                        str = '已报名';
                    } else {
                        str = '<span style="color: green;">已签到</span>';
                    }
                    $('#tasks').append('<tr><td>' + data[i].id + '</td><td>' + data[i].sname + '</td><td>' + data[i].sid + '</td><td>' + data[i].name + '</td><td>' + str + '</td></tr>');
                }
            }, 'json')
        });
    });
</script>
<table class="layui-table" align="center" style="width: 96%;margin: 20px auto;text-align: center;">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>记录编号</th>
        <th>学生姓名</th>
        <th>学号</th>
        <th>活动名称</th>
        <th>状态</th>
    </tr>
    </thead>
    <tbody id="tasks">
    @forelse($arrs as $value)
        <tr>
            <td>{{$value['id']}}</td>
            <td>{{$value['sname']}}</td>
            <td>{{$value['sid']}}</td>
            <td>{{$value['name']}}</td>
            <td>
                @if($value['status']=='0')
                    已报名
                @else
                    <span style="color: green;">已签到</span>
                @endif
            </td>
    @empty
        <tr>
            <td colspan="6">没有数据</td>
        </tr>
        @endforelse
        </tr>
    </tbody>
    <div class="showECode">
        <img src="" alt="" width="100%" height="100%">
    </div>
    <style>
        img {
            cursor: pointer;
        }

        .showECode {
            width: 250px;
            height: 250px;
            background: #fff;
            position: absolute;
            left: 33%;
            top: 23%;
            display: none;
            overflow: hidden;
            padding: 10px;
        }
    </style>
    <script>
        $('.Ecode').hover(function () {
            $('.showECode').show();
            $('.showECode img').attr('src', $(this).attr('src'))
        }, function () {
            $('.showECode').hide();
        })
    </script>
</table>
