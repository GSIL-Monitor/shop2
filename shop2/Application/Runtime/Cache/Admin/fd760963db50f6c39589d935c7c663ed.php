<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
		<script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>   
        <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>		
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/handlers.js"></script>
<title>评论管理</title>
</head>

<body>
<div class="page-content clearfix">
 <div class="sort_adsadd_style">
  <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()"  id="ads_add" title="添加品牌" class="btn btn-warning Order_form"><i class=""></i>商家回复评论列表</a>
       
       </span>
       <span class="r_f">共：<b><?php echo ($count); ?></b>条评论</span>
     </div>
 <!--列表样式-->
    <div class="sort_Ads_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
        <thead>
         <tr>             
                <th width="60px">编号</th>
                <th width="180">买家评论内容</th>
                <th width="180">回复评论内容</th>      
                <th width="120">评论时间</th>
                <th width="70">操作</th>
            </tr>
        </thead>
    <tbody>
        <?php if(is_array($reply)): foreach($reply as $key=>$vo): ?><tr>
    
       <td><?php echo ($vo['id']); ?></td>
       <td><?php echo ($vo['content']); ?></td>
       <td><?php echo ($vo['content1']); ?></td>
       <td><?php echo ($vo['addtime']); ?></td>
      <td class="td-manage">  
        <a title="删除" href="javascript:;"  onclick="del(this,<?php echo ($vo["id"]); ?>,<?php echo ($vo["aid"]); ?>)" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
      </tr><?php endforeach; endif; ?>

     
    </tbody>
    </table>

    <div class="row">
      <div class="col-sm-6">
      <div class="dataTables_info" id="sample_table_info" role="status" aria-live="polite">第 1 到<?php echo ($count); ?>条记录，共<?php echo ($count); ?>条</div>
      </div>
      <div class="col-sm-6">
      <div class="dataTables_paginate paging_bootstrap" id="sample_table_paginate">
      <ul class="pagination">
      <a href="#"><?php echo ($pagebtn); ?></a>

      </ul>
      </div>
      </div>
      </div>
     </div>
 
 </div>
</div>  

<!--添加广告样式-->
<div id="add_ads_style"  style="display:none">  
<form action="<?php echo U('Photo/doAddPhoto');?>" method="post" enctype="multipart/form-data" />
 <div class="add_adverts">
 <ul>
  <li><label class="label_name">名字</label><span class="cont_style"><input name="title" type="text" id="form-field-1"  class="col-xs-10 col-sm-5" style="width:450px"></span></li>
  <li>
  <label class="label_name">所属分类</label>
  <span class="cont_style">
  <select class="form-control" id="form-field-select-1" name="role">
    <option value="">选择分类</option>
    <option value="1">轮播图</option>
    <option value="2">广告</option>
</select>
    </span> 
  </li>
<li>
  <label class="label_name">商品分类</label>
  <span class="cont_style">
  <select class="form-control" id="form-field-select-1" name="goods">
    <option value="">选择分类</option>
    <?php if(is_array($types)): foreach($types as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?> 
</select>
    </span> 
  </li>
  
    

  <li><label class="label_name">链接地址</label><span class="cont_style"><input name="link" type="text" id="form-field-1"  class="col-xs-10 col-sm-5" style="width:450px"></span></li>  
   <li><label class="label_name">状&nbsp;&nbsp;态：</label>
   <span class="cont_style">
     &nbsp;&nbsp;<label><input name="status" type="radio" checked="checked" value="1" class="ace"><span class="lbl">显示</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="status" type="radio" value="2" class="ace"><span class="lbl">隐藏</span></label></span><div class="prompt r_f"></div>
     </li>
     <li><label class="label_name">图片</label><span class="cont_style">
        <input type="file" name="pic" class="col-xs-10 col-sm-5">
        </span>
    </li>
      <li style="margin-left:100px" width="100px">
        <input type="submit"   value="提交" >

    </li>
 
  
 </ul>
 </div>
 </form>
</div>
</body>
</html>


<script>

/*评论-删除*/
function del(obj, id,aid) {

    layer.confirm('确认要删除吗？',function(index){

        $.ajax({
            url: "<?php echo U('Assess/delReplyData');?>",
            type: "post",
            data: "id="+id+"&aid="+aid,
            success: function (msg) {

                if (msg['code'] == 1200) {

              
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000}); 
                } else {

                    layer.msg('系统有误! 请尽快联系程序员!!',{icon:1,time:1000});
                }
            },
            dataType: "json"
        });
    });    
}
</script>