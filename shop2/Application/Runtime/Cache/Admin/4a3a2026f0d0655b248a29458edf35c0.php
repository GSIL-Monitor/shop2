<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改状态</title>
	<link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/shop2/Public/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
        <link href="/shop2/Public/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />   
</head>
<body>
	
	<a style="text-decoration:none" class="btn btn-xs btn-success" <?=$status==1?'disabled':''?> href="<?php echo U('Goods/updateStatus',[id=>$id,status=>1]);?>" title="新添加" >新添加</a>
	<a title="在售中" <?=$status==2?'disabled':''?> class="btn btn-xs btn-info" href="<?php echo U('Goods/updateStatus',[id=>$id,status=>2]);?>">在售中</a>
	<a title="已下架" class="btn btn-xs btn-warning" href="<?php echo U('Goods/updateStatus',[id=>$id,status=>3]);?>" <?=$status==3?'disabled':''?> >已下架</a>
</body>
</html>
<script type="text/javascript">
	//disabled 无法点击属性

</script>