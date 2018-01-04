<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
		<script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="/shop2/Public/js/dragDivResize.js" type="text/javascript"></script>
<title>添加权限</title>
</head>



<body>
<div class="Competence_add_style clearfix">
  <div class="left_Competence_add">
   <div class="title_name">修改角色</div>
    <div class="Competence_add">
    <form action="<?php echo U('Rbac/editRuleData');?>"  method="post" id="form1">
    	<input type="hidden" name="id" value="<?php echo ($id); ?>">
        <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 角色名称 </label>
            <div class="col-sm-9"><input type="text" id="form-field-1" placeholder=""  value="<?php echo ($groupData['title']); ?>" name="title" class="col-xs-10 col-sm-5"></div>
	    </div>
        <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 角色描述 </label>
            <div class="col-sm-9"><textarea name="desc" class="form-control" id="form_textarea" value="<?php echo ($groupData['title']); ?>"  onkeyup="checkLength(this);"><?php echo ($groupData['desc']); ?></textarea></div>
	    </div>
   <br>
   <!--按钮操作-->
   <div class="Button_operation" >
				<button  class="btn btn-primary radius" type="submit" id="submit"><i class="fa fa-save "></i> 保存并提交</button>
				<button  class="btn btn-secondary  btn-warning" type="button"><i class="fa fa-reply"></i> 返回上一步</button>
				<button  class="btn btn-default radius" type="reset">&nbsp;&nbsp;取消&nbsp;&nbsp;</button> 
    </div>
   </div>
   </div>
   <!--权限分配-->
   <div class="Assign_style">
        <div class="title_name">权限分配</div>

  <div class="Select_Competence">
 
    <!-- <foreach name="allRules" item="vo"> -->
    <?php
 foreach ($allRules as $v) : $name = substr_count($v['path'], ','); switch ($name) { case 1: $str = '<b style="color:green;">'.$v['title'].'</b>'; break; case 2: $str = '<i style="color:#f60;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╚═════════════'.$v['title'].'</i>'; break; case 3: $str = '<i style="color:#f78;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╚═════════════════════════'.$v['title'].'</i>'; break; } ?>
		<label><input type="checkbox" value="<?php echo ($v['id']); ?>" <?php if(in_array(($v["id"]), is_array($rules)?$rules:explode(',',$rules))): ?>checked<?php endif; ?>  name="rule[]"><?php echo ($str); ?></label><br>

<?php endforeach;?>

  </div>
  </div>
        </form>
</div>
</body>
</html>
<script type="text/javascript">
//初始化宽度、高度  
 $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();; 
 $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
 $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	
	$(".Assign_style").width($(window).width()-500).height($(window).height()).val();
	$(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
	$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	});

$(function(){  
      var dataformInit = $("#form1").serializeArray();   
      var jsonTextInit = JSON.stringify({ dataform: dataformInit });  
      $("#submit").click(function(){  
             var dataform = $("#form1").serializeArray();  
             var jsonText = JSON.stringify({ dataform: dataform });  
             if(jsonTextInit==jsonText)  
             {   
                     alert("您并未作出任何修改");  
                     return false;  
             }  
  
      })  
  
}) 


</script>