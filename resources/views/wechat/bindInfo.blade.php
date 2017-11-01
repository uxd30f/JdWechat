<!DOCTYPE html>
<html class="ui-page-login">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<link href="{{ asset('css/mui.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
		
		<link href="{{ asset('css/mui.picker.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/mui.poppicker.css') }}" rel="stylesheet" />
		<script src="{{ asset('js/mui.min.js') }}"></script>
		<script src="{{ asset('js/mui.picker.js') }}"></script>
		<script src="{{ asset('js/mui.poppicker.js') }}"></script>
		
		<style>
			.area {
				margin: 20px auto 0px auto;
			}
			
			.mui-input-group {
				margin-top: 10px;
			}
			
			.mui-input-group:first-child {
				margin-top: 20px;
			}
			
			.mui-input-group label {
				width: 22%;
			}
			
			.mui-input-row label~input,
			.mui-input-row label~select,
			.mui-input-row label~textarea {
				width: 78%;
			}
			
			.mui-checkbox input[type=checkbox],
			.mui-radio input[type=radio] {
				top: 6px;
			}
			
			.mui-content-padded {
				margin-top: 25px;
			}
			
			.mui-btn {
				padding: 10px;
			}
			
			.link-area {
				display: block;
				margin-top: 25px;
				text-align: center;
			}
			
			.spliter {
				color: #bbb;
				padding: 0px 8px;
			}
			
			.oauth-area {
				position: absolute;
				bottom: 20px;
				left: 0px;
				text-align: center;
				width: 100%;
				padding: 0px;
				margin: 0px;
			}
			
			.oauth-area .oauth-btn {
				display: inline-block;
				width: 50px;
				height: 50px;
				background-size: 30px 30px;
				background-position: center center;
				background-repeat: no-repeat;
				margin: 0px 20px;
				/*-webkit-filter: grayscale(100%); */
				border: solid 1px #ddd;
				border-radius: 25px;
			}
			
			.oauth-area .oauth-btn:active {
				border: solid 1px #aaa;
			}
			
			.oauth-area .oauth-btn.disabled {
				background-color: #ddd;
			}
		</style>

	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">绑定账号</h1>
		</header>
		<div class="mui-content">

			<form action="{{ url('addUser') }}" method="post" id='login-form' class="mui-input-group">
					{{ csrf_field() }}
					<input type="hidden" name="openid" value="{{ $user['openid'] }}">
					<input type="hidden" name="nickname" value="{{ $user['nickname'] }}">
					<input type="hidden" name="sex" value="{{ $user['sex'] }}">
					<input type="hidden" name="headimgurl" value="{{ $user['headimgurl'] }}">
				
				<div class="mui-input-row">
						<label>学号</label>
						<input type="text" name="student_id" id='account' placeholder="请输入学号" value="{{ old('student_id') }}" class="mui-input-clear mui-input">
				</div>
				@if ($errors->has('student_id'))
				<div  style="color:red;text-align:center;margin-top:3px;margin-bottom:5px;"><span>{{ $errors->first('student_id') }}</span></div>
				@endif
				
				<div class="mui-input-row">
						<label>姓名</label>
						<input type="text" name="name" id="" placeholder="请输入姓名"  value="{{ old('name') }}"  class="mui-input-clear mui-input">
				</div>
				@if ($errors->has('name'))
				<div  style="color:red;text-align:center;margin-top:3px;margin-bottom:5px;"><span>{{ $errors->first('name') }}</span></div>
				@endif
				
				<div class="mui-input-row">
						<label>手机</label>
						<input type="number" name="phone" id="" placeholder="请输入手机号码"  value="{{ old('phone') }}"  class="mui-input-clear mui-input">
				</div>
				@if ($errors->has('phone'))
				<div  style="color:red;text-align:center;margin-top:3px;margin-bottom:5px;"><span>{{ $errors->first('phone') }}</span></div>
				@endif
				
				
				<div class="mui-input-row" id="sex_select">
						<label>性别</label>
						<input type="text" name='sex' id="sex_input" value="男" class="mui-input-clear mui-input">
				</div>
				
				<div class="mui-input-row" id="height_select">
						<label>身高</label>
						<input type="text" name='height' id="height_input" value="168" class="mui-input-clear mui-input">
				</div>
				
				<div class="mui-input-row" id="special_select">
						<label>特长</label>
						<input type="text" name='special' id="special_input" value="无特长" class="mui-input-clear mui-input">
				</div>
				
				
				
				
				<div class="mui-content-padded">
				<button id='login' type="submit" class="mui-btn mui-btn-block mui-btn-primary">绑定</button>
			</div>
		  </form>
			
			
			<div class="mui-content-padded oauth-area">

			</div>
		</div>
		
	</body>
	
	<script>
	// 选择性别
	document.querySelector('#sex_select').addEventListener("tap",function() {
		var roadPick = new mui.PopPicker(); //获取弹出列表组建，假如是二联则在括号里面加入{layer:2}
		roadPick.setData([{ //设置弹出列表的信息，假如是二联，还需要一个children属性
			value: "男",
			text: "男"
		},
		{
			value: "女",
			text: "女"
		}]);
		
		roadPick.pickers[0].setSelectedValue(document.querySelector('#sex_input').value, 2000);
		roadPick.show(function(item) { //弹出列表并在里面写业务代码
			var itemCallback = roadPick.getSelectedItems();
			
			document.querySelector('#sex_input').value = itemCallback[0].text;
		});
	});
	
	
	var height_data = new Array();
	for (var i = 130; i < 220; i++ ) {
		
		height_data.push({text:i,value:i});
	}
	// 选择身高
	document.querySelector('#height_select').addEventListener("tap",function() {
		var roadPick = new mui.PopPicker(); //获取弹出列表组建，假如是二联则在括号里面加入{layer:2}
	
		roadPick.setData(height_data);
		
		roadPick.pickers[0].setSelectedValue(document.querySelector('#height_input').value, 2000);
		roadPick.show(function(item) { //弹出列表并在里面写业务代码
			var itemCallback = roadPick.getSelectedItems();
			
			document.querySelector('#height_input').value = itemCallback[0].text;
		});
	});
	
	// 选择特长
	document.querySelector('#special_select').addEventListener("tap",function() {
		var roadPick = new mui.PopPicker(); //获取弹出列表组建，假如是二联则在括号里面加入{layer:2}
		roadPick.setData([{ //设置弹出列表的信息，假如是二联，还需要一个children属性
			value: "无特长",
			text: "无特长"
		},
		{
			value: "力气大",
			text: "力气大"
		},
		{
			value: "长的高",
			text: "长的高"
		},
		{
			value: "打篮球",
			text: "打篮球"
		}]);
		
		roadPick.pickers[0].setSelectedValue(document.querySelector('#special_input').value, 2000);
		roadPick.show(function(item) { //弹出列表并在里面写业务代码
			var itemCallback = roadPick.getSelectedItems();
			
			document.querySelector('#special_input').value = itemCallback[0].text;
		});
	});
	

	</script>

</html>