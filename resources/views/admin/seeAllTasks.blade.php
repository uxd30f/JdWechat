<link rel="stylesheet" type="text/css" href="{{asset('themes/layui/css/layui.css')}}">
<script src="{{asset('themes/desktop/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/layui/lay/dest/layui.all.js')}}"></script>
<table class="layui-table" align="center" style="width: 96%;margin: 60px auto;text-align: center;">
    <colgroup>
        <col width="350">
        <col width="200">
    </colgroup>
    <thead>
    <tr>
        <th>活动名称</th>
        <th>发布者</th>
        <th>开始时间</th>
        <th>价值工时</th>
        <th>参加人数</th>
        <th>二维码</th>
    </tr>
    </thead>
    <tbody>
    @forelse($tasks as $value)
        <tr>
            <td>{{ $value['name'] }}</td>
            <td>{{ $value['Publisher'] }}</td>
            <td>{{ $value['start_time'] }}</td>
            <td>{{ $value['work_hours'] }}</td>
            <td>{{ $value['need_num'] }}</td>
            <td>
                <img width="20" height="20" class="Ecode" src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{ $value['ticket'] }}" alt="">
            </td>
    @empty
        <tr>
            <td colspan="6">没有数据</td>
        </tr>
        @endforelse
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
