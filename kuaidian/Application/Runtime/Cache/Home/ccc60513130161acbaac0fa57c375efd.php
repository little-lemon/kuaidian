<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>快点--个人注册</title>
	<link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery-1.4.4.js"></script>

<style type="text/css">
.mycontainer{
	width:550px;
	height:300px;
	background:#ffffff;
	position:absolute;
	left:50%;
	top:50%;
	transform:translate(-50%,-50%);
	border-radius:10px;
}
.mydiv{
	position:absolute;
	top:5%;
	width:100%;
}
.myform-control{
	width: 150px;
	height: 34px;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 1.42857143;
	color: #555;
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
}
.logo-title {
    float: left;
    height: 34px;
    line-height: 34px;
    font-size: 24px;
    color: #333;
    padding-left: 30px;
    margin-top: 34px;
}
.have-account {
    font-size: 16px;
    float: right;
    margin-top: 55px;
    color: #999;
}
</style>
</head>
<body>
<div class="container"  style="width:auto;">
	<div class="logo-title" >欢迎注册</div>  
	<div class="have-account" >已有账号？<a href="<?php echo U('login'); ?>" style="color: #666; text-decoration: none;">请登录</a></div>
	
</div>
<hr style="border:1px solid; border-color:grey grey grey grey; height:3px; color:yellow; background-color:#999999; " />
<div class="container mycontainer">
<form class="form-horizontal" role="form"  method="post"  action="" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="inputUsername" class="col-sm-2 control-label" style="color:#666;">用户名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsername" name="username" placeholder="您的账户名和登录名">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword1" class="col-sm-2 control-label" style="color:#666;">设置密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword1" name="password" placeholder="建议至少使用两种字符组合">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword2" class="col-sm-2 control-label" style="color:#666;">确认密码</label>
    <div class="col-sm-10">
      <input type="password"  class="form-control"  id="inputPassword2" name="cpassword" placeholder="请再次输入密码">
    </div>
  </div>
  <div class="form-group">
    <label for="inputName" class="col-sm-2 control-label" style="color:#666;">真实姓名</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control"  id="inputName" name="truename" placeholder="请输入真实姓名">
    </div>
  </div>
  <div class="form-group">
    <label for="inputTel" class="col-sm-2 control-label" style="color:#666;">联系方式</label>
    <div class="col-sm-10">
      <input type="tel"  class="form-control"  id="inputTel" name="tel" placeholder="请输入手机号码">
    </div>
  </div>
  <div class="form-group">
    <label for="inputStorename" class="col-sm-2 control-label" style="color:#666;">店铺名</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control"  id="inputStorename" name="storename" placeholder="请输入店铺名">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label" style="color:#666;">店铺地址</label>
    	<div class="col-sm-10">
    		省份：
	       <select id="province"   name="province"  onchange="showcity()" >
	           <option value="0">-请选择-</option>
	       </select>&nbsp;&nbsp;
	       城市：
	       <select id="city"  name="city"   onchange="showarea()">
	           <option value="0">-请选择-</option>
	       </select>&nbsp;&nbsp;
	      地区：
	       <select id="area"  name="area"  onchange="showaddr()" >
	           <option value="0" >-请选择-</option>
	       </select>&nbsp;&nbsp;
	       <input type="text"  id="addr"  name="addr"  style="display:none" />
    	</div>
  </div>
  <div class="form-group">
    <label for="inputStoreaddr" class="col-sm-2 control-label" style="color:#666;">详细地址</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control"  id="inputStoreaddr" name="detailedaddress" placeholder="请输入店铺地址">
    </div>
  </div>
  <div class="form-group">
    <label for="inputStoredesc" class="col-sm-2 control-label" style="color:#666;">店铺描述</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control"  id="inputStoredesc" name="storedesc" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputStorelogo" class="col-sm-2 control-label" style="color:#666;">店铺logo</label>
    <div class="col-sm-10">
      <input type="file"  class="form-control"  id="inputStorelogo" name="logo" placeholder="选择文件">
    </div>
  </div>
  <div class="form-group">
  		<label for="checkcode" class="col-sm-2 control-label" style="color:#666;">验证码</label>
  		<div class="col-sm-10">
			<input type="text" placeholder="请输入验证码"  class="myform-control"   id="checkcode"  name="chkcode"   />&nbsp;
			<img onclick="this.src='<?php echo U('chkcode'); ?>#'+Math.random();" src="<?php echo U('chkcode'); ?>" />&nbsp;
			<a href="#" onclick="$(this).prev('img').trigger('click');" style="color:#00C5CD;">看不清？换一张</a>
		</div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"  name="mustclick" checked="checked" /> 我已阅读并同意《用户注册协议》
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger btn-lg btn-block">立即注册</button>
    </div>
  </div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
var xmldom = null; //声明变量用于存储全部的xml document对象信息

$(function(){
	//页面加载完毕立即获得省份信息
	//ajax去服务器端获得省份信息
	$.ajax({
		url:'/Public/Home/ChinaArea.xml',
		type:'get',
		dataType:'xml',
		success:function(msg){
			//alert(msg);//object XMLDocument
			//jquery处理html和xml的方式一致
			xmldom = msg;

			//console.log($(msg).find("province")); //从msg节点中中获得“后代”province节点
			$(msg).find("province").each(function(k,v){
				//k代表province的下标，v和this分别代表每个province的dom对象
				var nm = $(this).attr('province');
				var id = $(this).attr('provinceID');
				$("#province").append("<option value='"+id+"'>"+nm+"</option>");
			});
		}
	});
});

//通过省份显示城市的信息
function showcity(){
	//获得选中省份的value值
	var pid = $("#province").val();
	//省份id只保留前两位
	var two_pid = pid.substr(0,2);
	
	//清空旧的城市信息
	$("#city").empty();
	$("#city").append("<option value='"+0+"'>"+'请选择'+"</option>");
	//获得xml地区信息的City标签，条件是ID开始内容是two_pid;
	$(xmldom).find("City[CityID^="+two_pid+"]").each(function(){
		var nm = $(this).attr('City');//城市名称
		var id = $(this).attr('CityID');//城市id

		//把“名称”和“id”追加给下拉列表
		$("#city").append("<option value='"+id+"'>"+nm+"</option>");
	});
}

//通过城市显示地区的信息
function showarea(){
	//获得选中省份的value值
	var pid = $("#city").val();
	//省份id只保留前两位
	var four_pid = pid.substr(0,4);
	//清空旧的城市信息
	$("#area").empty();
	$("#area").append("<option value='"+0+"'>"+'请选择'+"</option>");
	//获得xml地区信息的City标签，条件是ID开始内容是two_pid;
	$(xmldom).find("Piecearea[PieceareaID^="+four_pid+"]").each(function(){
		var nm = $(this).attr('Piecearea');//城市名称
		var id = $(this).attr('PieceareaID');//城市id

		//把“名称”和“id”追加给下拉列表
		$("#area").append("<option value='"+id+"'>"+nm+"</option>");
	});
}

function showaddr(){
	var text1 = $("#province").find("option:selected").text();
	var text2 = $("#city").find("option:selected").text();
	var text3= $("#area").find("option:selected").text();
	var text = text1+","+text2+","+text3;
	//document.getElementById("addr").value = text;  //方法1
	$("#addr").attr('value',text);   //方法2
}

/*$("#province").click(function(){
	var text = $(this).find("option:selected").text();
	alert(text);
	$(".province").innerText = text;
});*/

/*$(function(){
    $(":button").click(function() {
        var str = $("#test option").map(function(){return $(this).val();}).get().join(", ")
        alert(str);
    });
});*/
</script>