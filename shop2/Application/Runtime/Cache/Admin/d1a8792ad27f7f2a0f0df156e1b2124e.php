<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/shop2/Public/assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="/shop2/Public/assets/js/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
		<script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="/shop2/Public/js/H-ui.js"></script> 
        <script type="text/javascript" src="/shop2/Public/js/H-ui.admin.js"></script> 
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
        <style>
        	.myselfcss{
				position:absolute;
				top:250px;
				left:450px;
        	}
        </style>
<title>用户列表</title>
</head>
<body>
     <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()" id="member_add" class="btn btn-warning">添加链接</a>
       </span>
     </div>
<div class="add_menber" id="add_menber_style" style="display:block">
    <form action="<?php echo U('Link/addLink');?>" enctype="multipart/form-data" method="post">
        <ul class=" page-content">
             <li><label class="label_name">链接名：</label><span class="add_name"><input id="linkname" style="width:280px;" value="" name="name" type="text"  class="text_add"/ placeholder="2-6位的字母,数字,下划线或中文组成"></span><div class="prompt r_f"></div></li>
             <li><label class="label_name">链接地址：</label><span class="add_name"><input name="url" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
             <li><label class="label_name">链接简介：</label><span class="add_name"><input style="width:280px;" name="brief" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
             <li><label class="label_name">链接图片：</label><span class="add_name"><input name="pic" type="file"  class="text_add"/></span><div class="prompt r_f"></div></li>
             <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="add_name">
             <label><input name="status" type="radio" class="ace" value="1"><span class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
             <label><input name="status"type="radio" class="ace" value="2"><span class="lbl">关闭</span></label></span><div class="prompt r_f"></div></li>
        </ul>
     <div class="myselfcss">
        <label>
            <input type="submit"  class="btn btn-search" value="提交"/>
            <a href="<?php echo U('Link/index');?>" class="btn btn-danger">取消</a>
        </label>
    </div>
   </form>
 </div>
  <!-- <button class="btn_search" type="button">提</button>
  <button class="btn_search" type="button">取消</button> -->

 <script>

    $('#linkname').blur(function() {
        console.log(111);
        var linknameVal = $('#linkname').val();
        if (linknameVal.length == 0) {
            $(this).nextAll('span').remove();
            $(this).after('<span style="color:red;">链接名不能为空</span>');
            return false;
        }
        if (linknameVal == $('#linkname').attr('title')) {
            return false;
        }
         $.ajax({
                type:'post',
                url:'<?php echo U("Link/handlerLinkExist");?>',
                data:{'linkname':linknameVal},
                success:function (msg) {
                    $('#linkname').attr('title',linknameVal);
                    if (msg.code == 1200) {
                        $('#linkname').nextAll('span').remove();
                        $('#linkname').after('<span style="color:red;">链接名已存在</span>');
                    }
                },
                dataType:'json',

            });
    })
    // $('#linkname').blur(function(){
    //     var linknameVal = $(this).val();
    // })
 </script>	
</body>
</html>