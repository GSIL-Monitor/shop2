<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑品牌</title>
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
</head>

<body>
<div class=" clearfix">
<div id="add_brand" class="clearfix">
<form action="<?php echo U('Goods/handlerEditData');?>" method="post" enctype="multipart/form-data" />
    <div class="left_add">

    <?php if(is_array($brandData)): foreach($brandData as $key=>$vo): ?><div class="title_name">编辑品牌</div>
        <ul class="add_conent">
            <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
            <li class=" clearfix">
                <label class="label_name"><i>*</i>品牌名称：</label> 
                <input name="name" type="text" class="add_text" maxlength="12" style="width:300px;" autofocus value="<?php echo ($vo["name"]); ?>" />
            </li>
            <li class=" clearfix">
                <label class="label_name">品牌图片：</label>
                <input type="file" name="pic" />
                <img src="/shop2/Public/Uploads/<?php echo ($vo["logo"]); ?>" style="width:150px; heigth:60px;" />
            </li>
            <li class=" clearfix">
                <label class="label_name">品牌描述：</label> 
                <textarea name="desc" class="textarea" placeholder="请用50个字符以内描述你的品牌.." maxlength="50" style="height:100px; font-size:16px;"><?php echo ($vo["desc"]); ?></textarea>
            <li class=" clearfix">
                <label class="label_name"><i>*</i>显示状态：</label> 
                <label>
                    <input name="show" type="radio" class="ace" value="1"
                    <?php if(($vo['status'] == 1)): ?>checked<?php endif; ?>
                     >
                    <span class="lbl">显示</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input type="radio" class="ace" name="show" value="2" 
                        <?php if(($vo['status'] == 2)): ?>checked<?php endif; ?>
                    >
                    <span class="lbl">不显示</span>
                </label>
            </li>
            <li class=" clearfix" style="text-align:center;">
                <label>
                    <input type="submit"  class="btn btn-warning" value="保存"/>
                    <input name="" type="reset" value="取消" class="btn btn-warning"/>
                </label>
            </li>
        </ul>
    </div><?php endforeach; endif; ?>

</form>
</div>
</body>
</html>