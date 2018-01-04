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
<title>用户列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
    <!-- <div class="search_style"> -->
      <!-- <div class="title_names">搜索查询</div>
      <ul class="search_content clearfix">
       <li><label class="l_f">用户名称</label><input name="" type="text"  class="text_add" placeholder="输入会员名称、电话、邮箱"  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul> -->
      <br>
      <span class="">
        <a href="#" id="member_add" class="btn btn-warning"><i class=""></i>会员等级管理</a>
       </span>
       <br>
       <br>
   <!--  </div> -->
     <!---->
     <!-- <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('User/addUser');?>" id="member_add" class="btn btn-warning"><i class="icon-plus"></i>添加用户</a>
        <a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
       <span class="r_f">共：<b style="color:red;"><?php echo ($count); ?></b>个用户</span>
     </div> -->
     <!---->
     <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="100">用户等级</th>
				<th width="100">折扣</th>
        <th width="100">操作</th>
			</tr>
		</thead>
	<tbody>
		<?php if(is_array($disCount)): foreach($disCount as $key=>$vo): ?><tr>
	          <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
	          <td>
                 <?php
 if ($vo['role'] == 1) { echo '普通用户'; } else if ($vo['role'] == 2) { echo 'VIP'; } else { echo '钻石用户'; } ?>
            </td>
	          <td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','500','400')"><?php echo ($vo["discount"]); ?></u></td>
	          <td class="td-manage">
	          <a title="编辑" href="<?php echo U('User/editDiscount',['role'=>$vo['role']]);?>"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120">编辑</i></a> 
	          </td>
			</tr><?php endforeach; endif; ?>
      </tbody>
	</table>
   </div>
  </div>
 </div>
</div>