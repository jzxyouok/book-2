
<!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>我要换货</title>
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
	<!-- No Baidu Siteapp-->
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--<meta name="format-detection" content="telephone = no" />-->
	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="我要换货" />
	<meta name="msapplication-TileColor" content="#090a0a">
	<link rel="stylesheet" href="/css/m/css_style.css">
	<script type="text/javascript" src="/js/m/zepto.min.js"></script>
</head>
<body class="grayBy">
<div class="feedback_box">
	<div class="feed_title"><i class="sm_icon"></i>售后说明<b class="x_icon"></b></div>
	<div class="feed_box">
		<textarea id="literal" rows="2" cols="20" class="textarea_txt" placeholder="请描述您所遇到的问题..."></textarea>
		<span><font>0</font>/200</span>
	</div>
	<div class="picture_title"><i class="picture_icon"></i>添加照片</div>
	<ul class="picture_list clearfix">
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em><img src="/images/m/temp/p1.jpg" /></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
				<b class="pic_close"><i></i></b>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
	</ul>
</div>
<div class="op_box"><input id="Button1" type="button" value="提交申请" class="red_btn" onclick=" window.location.href = 'member.html';" /></div>
</body>
</html>
<script type="text/javascript">
    $(function () {
        var literal = document.getElementById('literal');
        var num = 200;
        literal.onkeyup = function () {
            if (this.value.length > 200) {
                alert('超过字数');
                literal.value = literal.value.substring(0, 200);
            }
            else {
                num = 200 - this.value.length;
                $(".feed_box font").text(num);
            }
        }
    });
</script>