
<!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>添加新地址</title>
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
	<meta name="apple-mobile-web-app-title" content="添加新地址" />
	<meta name="msapplication-TileColor" content="#090a0a">
	<link rel="stylesheet" href="/css/m/css_style.css">
	<script type="text/javascript" src="/js/m/zepto.min.js"></script>
</head>
<body class="grayBy">
<div class="addr_form_box">
	<div class="addr_input_box"><span>收货人</span><input id="name" type="text" placeholder="收货人" class="addr_input" value="张小明" /></div>
	<div class="addr_input_box"><span>联系电话</span><input id="name" type="text" placeholder="联系电话" value="13811223344" class="addr_input" /></div>
	<div class="addr_input_box">
		<span>所在地区</span>
		<div class="select_box">
			<select id="Select1">
				<option>广东省</option>
				<option>广西省</option>
			</select>
		</div>
		<div class="select_box">
			<select id="Select2">
				<option>广州市</option>
				<option>佛山市</option>
				<option>深圳市</option>
			</select>
		</div>
		<div class="select_box">
			<select id="Select3">
				<option>天河区</option>
				<option>白云区</option>
			</select>
		</div>
	</div>
	<div class="addr_input_box"><span>详细地址</span><textarea id="TextArea1" rows="2" cols="20" placeholder="详细地址" class="addr_textarea">文三西路西湖文化广场120号文三西路西湖文化广场120号</textarea></div>
</div>
<div class="op_box"><input id="Button1" type="button" value="保存" class="red_btn" onclick=" window.location.href = 'address.html';" /></div>
</body>
</html>