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

<style>
	.pagination ul {
    display: inline-block;
    margin-bottom: 0;
    margin-left: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
.pagination ul li {
  display: inline;
}

.pagination ul li.rows {
    line-height: 30px;
    padding-left: 5px;
}
.pagination ul li.rows b{color: #f00}

.pagination ul li a, .pagination ul li span {
    float: left;
    padding: 4px 12px;
    line-height: 20px;
    text-decoration: none;
    background-color: #fff;
    background: url('../images/bottom_bg.png') 0px 0px;
    border: 1px solid #d3dbde;
    /*border-left-width: 0;*/
    margin-left: 2px;
    color: #08c;
}
.pagination ul li a:hover{
    color: red;
    background: #0088cc;
}
.pagination ul li.first-child a, .pagination ul li.first-child span {
    border-left-width: 1px;
    -webkit-border-bottom-left-radius: 3px;
    border-bottom-left-radius: 3px;
    -webkit-border-top-left-radius: 3px;
    border-top-left-radius: 3px;
    -moz-border-radius-bottomleft: 3px;
    -moz-border-radius-topleft: 3px;
}
.pagination ul .disabled span, .pagination ul .disabled a, .pagination ul .disabled a:hover {
color: #999;
cursor: default;
background-color: transparent;
}
.pagination ul .active a, .pagination ul .active span {
color: #999;
cursor: default;
}
.pagination ul li a:hover, .pagination ul .active a, .pagination ul .active span {
background-color: #f0c040;
}
.pagination ul li.last-child a, .pagination ul li.last-child span {
    -webkit-border-top-right-radius: 3px;
    border-top-right-radius: 3px;
    -webkit-border-bottom-right-radius: 3px;
    border-bottom-right-radius: 3px;
    -moz-border-radius-topright: 3px;
    -moz-border-radius-bottomright: 3px;
}

.pagination ul li.current a{color: #f00 ;font-weight: bold; background: #ddd}
</style>

<title>品牌管理</title>
</head>

<body>
<div class="page-content clearfix">
  <div id="brand_style">
    <div class="search_style">
      <div class="title_names">搜索查询</div>
      <ul class="search_content clearfix">
      <form action="JavaScript:;" method="get">
         <li><label class="l_f">品牌名称</label><input name="" type="text"  class="text_add" placeholder="输入品牌名称"  style=" width:250px"/></li>
         <li style="width:90px;"><button type="submit" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </form>
      </ul>
    </div>
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('Brand/handlerAddAlsoShowAddView');?>"  title="添加品牌" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加品牌</a>
        <a href="<?php echo U('Brand/test', ['id' => 1]);?>" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>

      <?php if($count < 1): ?><span class="r_f" style="font-size:17px; color:red;">暂无数据, 请添加品牌~</span>
      <?php else: ?>
          <span class="r_f">共：<b style="color:red; font-size:16px;"  id="count_id"><?php echo ($count); ?></b>&nbsp;个品牌&nbsp;&nbsp;&nbsp;共启用： <b style="color:green; font-size:16px;" id="showCount_id"><?php echo ($showCount); ?></b>&nbsp;个</span><?php endif; ?>

     </div>
     <div class="pagination">
    　　<ul>
            <li><?php echo ($pageBtn); ?></li>
        </ul>
	</div>
     <!--品牌列表-->
      <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
    <thead>
     <tr>
        <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
        <th width="80px">ID</th>
        <th width="120px">品牌LOGO</th>
        <th width="120px">品牌名称</th>
        <th width="350px">描述</th>
        <th width="180px">加入时间</th>
        <th width="70px">状态</th>                
        <th width="200px">操作</th>
      </tr>
    </thead>
  <tbody>
  <?php if(is_array($pageData)): foreach($pageData as $key=>$vo): ?><tr>
          <td width="25px"><label><input type="checkbox" class="ace" ><span class="lbl"></span></label></td>
          <td width="80px"><?php echo ($vo["id"]); ?></td>
          <td><img src="/shop2/Public/Uploads/<?php echo ($vo["logo"]); ?>" style="height:50px; width:100px;" /></td>
          <td><?php echo ($vo["name"]); ?></td>
          <td class="text-l"><?=mb_substr($vo['desc'], 0, 15).'...'?></td>
          <td><?php echo ($vo["addtime"]); ?></td>
          <td class="td-status">
            <?php if(($vo['status'] == 1)): ?><span class="label label-success radius">已启用</span>
            <?php elseif(($vo['status'] == 2)): ?>
                <span class="label label-defaunt radius">已停用</span><?php endif; ?>
          </td>

          <td class="td-manage">
            <?php if(($vo['status'] == 1)): ?><a style="text-decoration:none" class="btn btn-xs btn-success" onclick="stop(this, <?php echo ($vo["id"]); ?>, <?php echo ($vo["status"]); ?>)" href="javascript:;" title="停用" aa="<?php echo ($vo["status"]); ?>"><i class="icon-ok bigger-120"></i></a>
            <?php elseif(($vo['status'] == 2)): ?>
                <a style="text-decoration:none" class="btn btn-xs " onclick="start(this, <?php echo ($vo["id"]); ?>, <?php echo ($vo["status"]); ?>)" href="javascript:;" title="启用" aa="<?php echo ($vo["status"]); ?>"><i class="icon-ok bigger-120"></i></a><?php endif; ?>
            
          <a title="编辑" href="<?php echo U('Brand/showAlsoHandlerEdit', [id=>$vo['id']]);?>"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
          <a title="删除" href="javascript:;" onclick="del(this, <?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-warning" id="outer"><i class="icon-trash  bigger-120"></i></a>
          </td>
    </tr><?php endforeach; endif; ?>      

        </tbody>
        </table>
        </div>
     </div>
    
  </div>
</div>
</body>
</html>
<script>

/*品牌-停用*/
function stop(obj, id, data) {

  layer.confirm('确认要停用吗？',

    function(index){

      $.ajax({

        url: "<?php echo U('Brand/handlerStatusData');?>",
        type: "post",
        data: "id="+id+"&status="+data+"&ment=2",
        success: function (msg) {
            if (msg['code'] == 1200) {

                $(obj).parents("tr").find(".td-manage").prepend("<a style='text-decoration:none' class='btn btn-xs ' onclick='start(this, "+id+" , 2)' href='javascript:;' title='启用' aa='2'><i class='icon-ok bigger-120'></i></a>");
                $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                $(obj).remove();
                var num = parseInt($('#showCount_id').html())-1;
                $('#showCount_id').html(num);
                layer.msg('已停用!',{icon: 5,time:1000});
            } else {

                layer.msg('系统有误, 请尽快联系程序员!',{icon: 5,time:1000});
            }
        },
        dataType: "json"
      });
  });
}
// layer.msg('已启用!',{icon: 6,time:1000});
/*用户-启用*/
function start(obj, id, data) {

  layer.confirm('确认要启用吗？',

    function(index){

      $.ajax({

        url: "<?php echo U('Brand/handlerStatusData');?>",
        type: "post",
        data: "id="+id+"&status="+data+"&ment=2",
        success: function (msg) {

            if (msg['code'] == 1200) {

                $(obj).parents("tr").find(".td-manage").prepend("<a style='text-decoration:none' class='btn btn-xs btn-success' onclick='stop(this, "+id+", 1)' href='javascript:;' title='停用' aa='1'><i class='icon-ok bigger-120'></i></a>");
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                var num = parseInt($('#showCount_id').html())+1;
                $('#showCount_id').html(num);
                layer.msg('已启用!',{icon: 6,time:1000});

            } else {

                layer.msg('系统有误, 请尽快联系程序员!',{icon: 5,time:1000});
            }
        },
        dataType: "json"
      });
  });
}

/*品牌-删除*/
function del(obj, id) {

    layer.confirm('确认要删除吗？',function(index){

        $.ajax({
            url: "<?php echo U('Brand/delBrandData');?>",
            type: "post",
            data: "id="+id,
            success: function (msg) {

                if (msg['code'] == 1200) {

                    var del = parseInt($(obj).prev().prev().attr("aa"));
                    var num = parseInt($('#showCount_id').html())-1;
                    var countNum = parseInt($('#count_id').html())-1;
                    
                    if (del == 1) {

                        $('#showCount_id').html(num);
                    }

                    $('#count_id').html(countNum);
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