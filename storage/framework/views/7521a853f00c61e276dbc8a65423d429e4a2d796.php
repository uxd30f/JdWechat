<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<style>
		body {
			text-align: center;
		}
		img {
			width: 40%;
			height: auto;
		}
	</style>
</head>
<body>
    <div style="margin:100px auto;width: 400px;height: 400px;text-align: center;color: green;">
        <img src="<?php echo e(asset('images/error.jpg')); ?>" alt="">
        <h2><?php echo e(isset($msg) ? $msg : '操作失败'); ?></h2>
        <a href="javascript:;" id="Rester">返回</a>
    </div>

    <script>

        window.onload=function () {
            document.getElementById('Rester').onclick=function () {
                history.go(-1);
            }
        }
    </script>
</body>
</html>