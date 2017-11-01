

    
    
    
    
    
    

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('themes/layui/css/layui.css')); ?>">
<script src="<?php echo e(asset('themes/desktop/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/layui/lay/dest/layui.all.js')); ?>"></script>
<form class="form" action="<?php echo e(url('admin/createTask')); ?>" style="padding: 20px;" method="post">
  <?php echo e(csrf_field()); ?>

    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">活动名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" placeholder="请输入活动名称" autocomplete="off" class="layui-input">
            <input type="hidden" name="Publisher" value="<?php echo e(session ('adminName')); ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">需要人数</label>
        <div class="layui-input-block">
            <input type="text" name="need_num" placeholder="请输入需要人数" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">价值工时</label>
        <div class="layui-input-block">
            <input type="text" name="work_hours" placeholder="请输入价值工时" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">活动日期</label>
        <div class="layui-input-inline">
            <input class="layui-input" placeholder="活动时间" id="LAY_demorange_s" name="start_time" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm'})">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">任务简介</label>
        <div class="layui-input-block">
            <textarea style="height: 180px;" name="brief" placeholder="请输入任务简介" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即发布</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        var start = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };

    });
	
	$(".form").submit(function(){
		if ($("input[name=name]").val() == "")
		{
			alert("名称不能为空");
			return false;
		}
		
		if ($("input[name=need_num]").val() == "")
		{
			alert("需要人数不能为空");
			return false;
		}
		if ($("input[name=work_hours]").val() == "")
		{
			alert("工时不能为空");
			return false;
		}
		
		if ($("input[name=start_time]").val() == "")
		{
			alert("时间不能为空");
			return false;
		}
		
		return true;
	});
</script>

<script>

</script>
</body>
</html>
