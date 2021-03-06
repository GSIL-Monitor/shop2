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
       
    <!-- page specific plugin scripts -->
    <script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
    <script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="/shop2/Public/js/H-ui.js"></script> 
        <script type="text/javascript" src="/shop2/Public/js/H-ui.admin.js"></script> 
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
         <script src="/shop2/Public/assets/dist/echarts.js"></script>
         <script src="/shop2/Public/js/lrtk.js" type="text/javascript"></script>
<title>分类管理</title>
</head>

<body>
<div class="page-content clearfix">
  <div id="brand_style">
    <div class="search_style">
      <div class="title_names">搜索查询</div>
      <ul class="search_content clearfix">
       <li><label class="l_f">分类名称</label><input name="" type="text"  class="text_add" placeholder="输入品牌名称"  style=" width:250px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
    </div>
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('Types/showTypeViewAlsoHandlerAdd');?>"  title="添加品牌" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加分类</a>
        <a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>

      <?php if($count < 1): ?><span class="r_f" style="font-size:17px; color:red;">暂无数据, 请添加分类~</span>
      <?php else: ?>
          <span class="r_f">共：<b style="color:green; font-size:16px;"  id="count_id"><?php echo ($count); ?></b>&nbsp;个顶级分类</span><?php endif; ?>

     </div>
     <div id="outerDiv"><?php echo ($pageBtn); ?></div>
     <!--品牌列表-->
      <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
    <thead>
     <tr>
        <th width="260px">ID</th>
        <th width="340px">分类类名</th>
        <th width="260px">父类ID</th>
        <th width="260px">path路径</th>             
        <th width="280px">操作</th>
      </tr>
    </thead>
  <tbody>

  <?php
 foreach ($typeDatas as $v) : $name = substr_count($v['path'], ','); switch ($name) { case 1: $str = '<b style="color:green;">'.$v['name'].'</b>'; break; case 2: $str = '<i style="color:#f60;">&nbsp;╚═'.$v['name'].'</i>'; break; case 3: $str = '<i style="color:#f78;">&nbsp;&nbsp;&nbsp;&nbsp;══'.$v['name'].'</i>'; break; } ?>
    <tr>
          <td width="80px"><?php echo ($v["id"]); ?></td>
          <td><span style="float:left;">&nbsp;<?=$str?></span></td>
          <td><?php echo ($v["pid"]); ?></td>
          <td><span style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($v["path"]); ?></span></td>
          <td class="td-manage">
              <a href="<?php echo U('Types/showTypeViewAlsoHandlerAdd', ['id' => $v['id']]);?>" title="子分类" class="btn btn-primary" style="width:42.41px; height:26px;"><i class="icon-plus"></i></a>
              <a title="编辑" href="<?php echo U('Types/showEditTypeAlsoHandlerEditData', ['id' => $v['id']]);?>"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
              <a title="删除" href="javascript:;" class="btn btn-xs btn-warning" onclick="del(this, <?=$v['id']?>)" aa="<?=$v['path']?>" /><i class="icon-trash  bigger-120"></i></a>
          </td>
    </tr>
  <?php endforeach;?>

        </tbody>
        </table>
        </div>
     </div>
    
  </div>
</div>
</body>
</html>

<script>

function del(obj, id) {

    layer.confirm('确定要删除吗?',function(index){
        layer.close(index);

        $.ajax({
            url: "<?php echo U('Types/delGoodsTypeData');?>",
            type: "post",
            data: "id="+id,
            success: function (msg) {

                if (msg['code'] == 1404) {

                    layer.msg('请先删除子类!', {icon:8, time:1000});
                } else if (msg['code'] == 1200) {

                    var pathStr = $(obj).attr('aa');
                    var countNum = parseInt($('#count_id').html())-1;

                    if (pathStr == '0,') {

                        $('#count_id').html(countNum);
                    }
                    $(obj).parents("tr").remove();
                    layer.msg('删除成功!', {icon:1, time:1000});
                } else if (msg['code'] == 1500) {

                    layer.msg('系统有误, 请尽快联系程序员!!', {icon:5,time:1000});
                }
            },
            dataType: "json"
        });
    });
}
</script>