

    <link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
<script src="{{asset('themes/desktop/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/layui/lay/dest/layui.all.js')}}"></script>
<table class="layui-table" align="center" style="width: 96%;margin: 60px auto;text-align: center;">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>序号</th>
        <th>学号</th>
        <th>姓名</th>
		<th>性别</th>
		<th>身高</th>
		<th>手机号码</th>
        <th>工时</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
      @forelse($students as $value)
        <tr>
            <td>{{ $value['id'] }}</td>
          <td>{{ $value['student_id'] }}</td>
          <td>{{ $value['name'] }}</td>
          <td>{{ $value['sex'] }}</td>
          <td>{{ $value['height'] }}</td>
		   <td>{{ $value['phone'] }}</td>
          <td>{{ $value['work_hour'] }}</td>
          <td><a href="javascript:;"  onclick="Edit({{ $value['id'] }})">修改</a></td>
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
        img{
            cursor: pointer;
        }
        .showECode{
            width: 250px;
            height: 250px;
            background: #fff;
            position: absolute;
            left:33%;
            top:23%;
            display: none;
            overflow: hidden;
            padding: 10px;
        }
    </style>
    <script>
        function Edit(id) {
            layer.open({
                type: 2,
                title: '学生信息',
                shadeClose: true,
                shade: 0.8,
                area: ['60%', '40%'],
                content: 'StudentInfo/'+id //iframe的url
            });

        }
        $('.Ecode').hover(function () {
            $('.showECode').show();
            $('.showECode img').attr('src',$(this).attr('src'))
        },function () {
            $('.showECode').hide();
        })
    </script>
</table>
<!-- </body>
</html> -->
