<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加颜色属性</title>
</head>
<link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/shop2/Public/css/style.css"/>     
<link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
<link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
<link rel="stylesheet" href="/shop2/Public/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome.min.css" />
<!--[if IE 7]>
      <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
<link href="/shop2/Public/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/shop2/Public/Widget/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
<script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
<script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>
<script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
<script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
<style>
	.ettr{
		display:inline-block;
	}
</style>
<body>
<form action="<?php echo U('Goods/addAttr');?>" method="post" enctype="multipart/form-data">
	<div>
  <input type="hidden" name="id" value="<?php echo ($id); ?>" id="gid">
	<div class="clearfix cl ettr">
         <label class="form-label col-2">选择颜色：</label>
       &nbsp;&nbsp;<select id="color_select" class="select" name="color" size="1" id="color_type" style="border-radius:5px;">
          <option value="">--请选择--</option>
          <option value="白色" color="#F56363">白色</option>
          <option value="黑色" color="#111111">黑色</option>
          <option value="灰色" color="#FF7F00">灰色</option>
          <option value="棕色" color="#FF7F00">棕色</option>
          <option value="粉色" color="#FF7F00">粉色</option>
          <option value="橙色" color="#EAFF56">橙色</option>
          <option value="紫色" color="#EAFF56">紫色</option>
          <option value="深蓝色" color="#E47833">深蓝色</option>
          <option value="浅蓝色" color="#6B8E23">浅蓝色</option>
          <option value="咖啡色" color="7FFF00">咖啡色</option>
          <option value="卡其色" color="#33FFFF">卡其色</option>
          <option value="藏青色" color="#E3F9FD">藏青色</option>
          <option value="米白色" color="#00E079">米白色</option>
          <option value="红色" color="#EAFF56">红色</option>
        </select>
    </div>
    <label id="imgs">
       <input type="file" id="file_upload" name="pic[]" multiple="multiple"/>
    </label>
	<div class="ettr">
		<div><label class="form-label col-2">尺寸：</label>
       &nbsp;&nbsp;<select class="select" name="size1" size="1" id="size_type" style="width:120px;
        border-radius:5px;">
          <option value="">--请选择--</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>
          <option value="36">36(鞋)</option>
          <option value="38">38</option>
          <option value="40">40</option>
          <option value="42">42</option>
          <option value="27">27(裤)</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="32">32</option>
        </select></div>
       <div><label class="form-label col-2">尺寸：</label>
       &nbsp;&nbsp;<select class="select" name="size2" size="1" id="size_type" style="width:120px;
        border-radius:5px;">
          <option value="">--请选择--</option>
          <option value="M">M</option>
         <option value="L">L</option>
          <option value="XL">XL</option>
          <option value="36">36(鞋)</option>
          <option value="38">38</option>
          <option value="40">40</option>
          <option value="42">42</option>
          <option value="27">27(裤)</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="32">32</option>
        </select></div>
       <div><label class="form-label col-2">尺寸：</label>
       &nbsp;&nbsp;<select class="select" name="size3" size="1" id="size_type" style="width:120px;
        border-radius:5px;">
          <option value="">--请选择--</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>
          <option value="36">36(鞋)</option>
          <option value="38">38</option>
          <option value="40">40</option>
          <option value="42">42</option>
          <option value="27">27(裤)</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="32">32</option>
        </select></div>
	</div>
	<div class="ettr">
		<div><label class="form-label col-2">数量：</label>
       &nbsp;&nbsp;<input type="number" value="" placeholder="" name="num1" style="width:100px;"></div>
       <div><label class="form-label col-2">数量：</label>
       &nbsp;&nbsp;<input type="number" value="" placeholder="" name="num2" style="width:100px;"></div>
       <div><label class="form-label col-2">数量：</label>
       &nbsp;&nbsp;<input type="number" value="" placeholder="" name="num3" style="width:100px;"></div>
	</div>
    </div><br>
    <div class="clearfix cl">
      <div class="Button_operation">
        <button class="btn btn-primary radius" type="submit" ><i class="icon-save"></i>保存</button>
        <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
      </div>
    </div>
	</form>
</body>
</html>
<script type="text/javascript">
  
  $('#color_select').change(function(){
    // console.log($("#color_select option:selected"));
      var select = $("#color_select option:selected");
      $('#img').css({"background":select.attr('color')});
      $('#img').attr({"value":select.attr('color')});
  });
  // console.log($('#gid').attr('value'));
  // var ids = $('#gid').attr('value');
  // $.ajax({
  //   type:'get',
  //   url:"<?php echo U('Goods/getColorImg');?>",
  //   data:'id='+ids,
  //   success:function(msg){
  //     for (var i = 0; i < msg.length; i++) {
  //       console.log(msg[i]);
  //       $('#imgs').append("<input type='radio' name='color_img' value='"+msg[i]+"'><img src='/shop2/Public/Uploads/"+msg[i]+"' width='50'>");
  //     };
  //   },
  //   dataType:'json'
  // });


</script>