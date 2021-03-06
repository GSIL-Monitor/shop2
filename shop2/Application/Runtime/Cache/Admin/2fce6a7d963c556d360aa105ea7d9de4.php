<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加属性</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome.min.css" />
        <link href="/shop2/Public/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
        <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>
         <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/handlers.js"></script>
        <style>
          
          #add_brand{
              margin-left:215px;
          }

          .add_conent{
              background-color:white;
          }

          .div_visibility{
              visibility:hidden ;
          }
          
        </style>
</head>

<body style="background-color:snow;">
<div id="add_brand" class="clearfix">
<form action="<?php echo U('Brand/doAdd');?>" method="post" />
    <div class="left_add" style="border:1px solid snow;">
        <div class="title_name">添加属性</div>
        <ul class="add_conent">
            <li class=" clearfix">
                <label class="label_name">颜色：</label> &nbsp;
                <select name="color"  class="select" style="width:100px; border-radius:5px;">
                    <option value="0">--请选择--</option>
                    <option value="1">红</option>
                    <option value="2">黄</option>
                    <option value="3">蓝</option>
                </select>
            </li>
            <li class=" clearfix">
                <label class="label_name">尺寸：</label>&nbsp;
                <select name="size"  class="select" style="width:100px; border-radius:5px;">
                    <option value="0">--请选择--</option>
                    <option value="1">x</option>
                    <option value="2">xl</option>
                    <option value="3">xxl</option>
                </select>
            </li>
            <li class=" clearfix">
                <label class="label_name">库存：</label> 
                <input type="number" name="stock" min="0" max="9999999" value="1" style="width:100px;" />
            </li>
            <li class=" clearfix">
                <label class="label_name">显示状态：</label> &nbsp;
                <label>
                    <input name="status" type="radio" class="ace" checked="checked" value="1">
                    <span class="lbl">在售中</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input type="radio" class="ace" name="status" value="2">
                    <span class="lbl">已下架</span>
                </label>
            </li>
            <li class=" clearfix" style="text-align:center;">
                <label>
                    <input type="submit" class="btn btn-primary" value="保存" />
                    <a href="javascript:;" class="btn btn-danger">取消</a>
                </label>
            </li>
        </ul>
    </div>
</form>
</div>
</body>
</html>