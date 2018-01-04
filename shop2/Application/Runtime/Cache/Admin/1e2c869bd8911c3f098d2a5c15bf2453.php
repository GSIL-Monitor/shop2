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
    <div class="search_style">
      <div class="title_names">搜索查询</div>
      <form action="<?php echo U('Link/index');?>" method="get">
      <ul class="search_content clearfix">
       <li><label class="l_f">链接名称</label><input name="name" type="text"  class="text_add" placeholder="输入链接名称"  style=" width:400px"/></li>
       <li style="width:90px;"><button type="submit" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
      </form>
    </div>
     <!---->
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('Link/addLink');?>" id="member_add" class="btn btn-warning"><i class="icon-plus"></i>添加链接</a>
       </span>
       <span class="r_f">共：<b><?php echo ($count); ?></b>条</span>
     </div>
     <!---->
     <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="80">链接编号</th>
				<th width="150">链接名</th>
				<th width="190">链接地址</th>
        <!-- <th width="100">链接名</th>
        <th width="80">链接地址</th> -->
				<th width="120">链接图片</th>
				<!-- <th width="150">链接简介</th> -->
        <th width="270">链接简介</th>
				<th width="180">添加时间</th>
        <!-- <th width="100">等级</th> -->
				<th width="70">状态</th>                
				<th width="250">操作</th>
			</tr>
		</thead>
	<tbody>
		<?php if(is_array($links)): foreach($links as $key=>$vo): ?><tr>
	          <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
	          <td><?php echo ($vo["id"]); ?></td>
	          <td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','500','400')"><?php echo ($vo["name"]); ?></u></td>
	          <td><?php echo ($vo["url"]); ?></td>
	          <td>
	          	<img src="/shop2/Public/Uploads/<?php echo ($vo["pic"]); ?>" style="height:50px;width:100px">
	          </td>
	          <td><?php echo ($vo["brief"]); ?></td>
	         <!--  <td class="text-l">北京市 海淀区</td> -->
	          <td><?php echo ($vo["addtime"]); ?></td>
	          <!-- <td>普通用户</td> -->
	          <td class="td-status">
		          	<?php if(($vo['status'] == 1)): ?><span class="label label-success radius">已启用</span>
	            <?php elseif(($vo['status'] == 2)): ?>
	                <span class="label label-defaunt radius">已停用</span><?php endif; ?>
	          </td>
	          <td class="td-manage">
	          	<?php if(($vo['status'] == 1)): ?><a style="text-decoration:none" class="btn btn-xs btn-success" onclick="stop(this, <?php echo ($vo["id"]); ?>, <?php echo ($vo["status"]); ?>)" href="javascript:;" title="停用" aa="<?php echo ($vo["status"]); ?>"><i class="icon-ok bigger-120"></i></a>
            	<?php elseif(($vo['status'] == 2)): ?>
                <a style="text-decoration:none" class="btn btn-xs " onclick="start(this, <?php echo ($vo["id"]); ?>, <?php echo ($vo["status"]); ?>)" href="javascript:;" title="启用" aa="<?php echo ($vo["status"]); ?>"><i class="icon-ok bigger-120"></i></a><?php endif; ?>
	          <a title="编辑" onclick="member_edit('550')" href="<?php echo U('Link/editLink',['id'=>$vo['id']]);?>"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
	         <a title="删除" href="javascript:;"  onclick="del(this, <?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
	          </td>
			</tr><?php endforeach; endif; ?>
      </tbody>
	</table>
  <div class="row">
      <div class="col-sm-6">
      <div class="dataTables_info" id="sample_table_info" role="status" aria-live="polite">第 1 到 <?php echo ($count); ?> 条记录，共 <?php echo ($count); ?> 条</div>
      </div>
      <div class="col-sm-6">
      <div class="dataTables_paginate paging_bootstrap" id="sample_table_paginate">
      <ul class="pagination">
      <a href="#"><?php echo ($pagebtn); ?></a>

      </ul>
      </div>
      </div>
      </div>
	<div>
   </div>
   </div>
  </div>
 </div>
</div>
</body>
</html>
<script>

/*链接-停用*/
function stop(obj, id, data) {

  layer.confirm('确认要停用吗？',

    function(index){

      $.ajax({

        url: "<?php echo U('Link/handlerStatusData');?>",
        type: "post",
        data: "id="+id+"&status="+data,
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

/*链接-启用*/
function start(obj, id, data) {

  layer.confirm('确认要启用吗？',

    function(index){
    	layer.close(index);

      $.ajax({

        url: "<?php echo U('Link/handlerStatusData');?>",
        type: "post",
        data: "id="+id+"&status="+data,
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

/*链接-删除*/
function del(obj, id) {

    layer.confirm('确认要删除吗？',function(index){

        $.ajax({
            url: "<?php echo U('Link/delLink');?>",
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