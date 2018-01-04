<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑尺寸数量</title>
	<link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
    <link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/shop2/Public/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome.min.css" />
    <script src="/shop2/Public/assets/js/jquery.min.js"></script>
    <script src="/shop2/Public/assets/js/ace-elements.min.js"></script>
	<script src="/shop2/Public/assets/js/ace.min.js"></script>
    <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
	<script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>
    <script type="text/javascript" src="/shop2/Public/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script>
    <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>
</head>
<body>
	
	<form action="<?php echo U('Goods/editSize');?>" method="post">
	<br><br>
	<label class="ace">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;尺寸:&nbsp;&nbsp;<input name="size" type="text"  class="text_add" value="<?php echo ($info['size']); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
	库存:<input name="num" type="text" class="text_add" value="<?php echo ($info['num']); ?>" /><br><br>
	<input type="hidden" value="<?php echo ($info['id']); ?>" name="id">
	<div class="Button_operation">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary radius" type="submit" id="submit"><i class="icon-save"></i>保存</button>
        <button onClick="javascript :history.back();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
      </div>
	</label>

	</form>
</body>
</html>
<script type="text/javascript">
	

</script>