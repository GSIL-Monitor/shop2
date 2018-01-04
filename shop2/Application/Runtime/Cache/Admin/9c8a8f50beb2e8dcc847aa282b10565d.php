<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
        <!-- // <script type="text/javascript" src="/shop2/Public/Widget/Validform/5.3.2/Validform.min.js"></script> -->
        <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>              
        <script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
        <script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
         <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>
  
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
<title>管理员</title>
</head>

<body>
<div class="page-content clearfix">
  <div class="administrator">
       <div class="d_Confirm_Order_style">
    <div class="search_style">
      <div class="title_names">搜索查询</div>
      <form action="<?php echo U('Rbac/admins');?>" method="get">
      <ul class="search_content clearfix">
       <li><label class="l_f">管理员名称</label><input name="name" type="text"  class="text_add" placeholder=""  style=" width:400px"/></li>
      
       <li style="width:90px;"><button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button></li>

      </ul>
      </form>
    </div>
    <!--操作-->
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('addAdmin');?>" class="btn btn-warning"><i class="fa fa-plus"></i> 添加管理员</a>
  <!--       <a href="javascript:;" class="btn btn-danger" id="piliang"><i class="fa fa-trash"></i> 批量删除</a> -->
       </span>
       <span class="r_f">共：<b><?php echo ($mm); ?></b>人</span>
     </div>
     <!--管理员列表-->
     <div class="clearfix administrator_style" id="administrator">
      <div class="left_style">
      <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
         <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list"><div class="widget-header header-color-green2"><h4 class="lighter smaller">管理员分类列表</h4></div>
         <div class="widget-body">
           <ul class="b_P_Sort_list">
           <li><i class="fa fa-users green"></i> <a href="#">全部管理员（<?php echo ($tt); ?>）</a></li>
           <?php if(is_array($pp)): foreach($pp as $key=>$vo): ?><li><i class="fa fa-users orange"></i> <a href="#"><?php echo ($vo['title']); ?>（<?php echo ($vo['num']); ?>）</a></li><?php endforeach; endif; ?>
           </ul>
        </div>
       </div>
      </div>  
      </div>
      </div>
      <div class="table_menu_list"  id="testIframe">
           <table class="table table-striped table-bordered table-hover" id="sample_table">
        <thead>
         <tr>
                <th width="40px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                <th width="90px">编号</th>
                <th width="140px">登录名</th>
                <th width="160px">手机</th>
                <th width="80px">性别</th>
                <th width="150px">角色</th>               
                <th width="180px">加入时间</th>
                <th width="80px">状态</th>                
                <th width="200px">操作</th>
            </tr>
        </thead>
    <tbody>
    <?php if(is_array($datas)): foreach($datas as $key=>$vo): ?><tr>
            <td><label><input type="checkbox" class="ace"  name="idq"><span class="lbl"></span></label></td>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["phone"]); ?></td>
              
            <?php if($vo['sex'] == 1): ?><td>男</td>
            <?php else: ?><td>女</td><?php endif; ?>
            <td><?php echo ($vo["title"]); ?></td>
            <td><?php echo ($vo["addtime"]); ?></td>
            <td class="td-status">
            <?php if($vo['status'] == 1): ?><span class="label label-success radius">已启用
            <?php else: ?><span class="label label-defaunt radius">已停用<?php endif; ?></span></td>
            <td class="td-manage">
            <?php if($vo['status'] == 1): ?><a onClick="member_stop(this,<?php echo ($vo["id"]); ?>,<?php echo ($vo["status"]); ?>)"  href="javascript:;" title="停用"  class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>  
            <?php else: ?><a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,<?php echo ($vo["id"]); ?>,<?php echo ($vo["status"]); ?>)" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a><?php endif; ?>
        <a title="编辑" href="<?php echo U('editAdmin',['id'=>$vo['id'],'name'=>$vo['name'] ] );?>" class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>       
        <a title="删除" href="javascript:;"  onclick="del(this,<?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
     </tr><?php endforeach; endif; ?>
    </tbody>
    </table>
      </div>
     </div>
  </div>
</div>
 <!--添加管理员-->
 <div id="add_administrator_style" class="add_menber" style="display:none">
    <form action="<?php echo U('doAddAdmin');?>" method="post" id="form-admin-add">
       

    
        <div> 
        <input class="btn btn-primary radius" type="submit" id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
    </form>
   </div>
 </div>
</body>
</html>
<script type="text/javascript">
    $('#user-name').blur(function () {
            

            //: 失去就保存   响应成功后才保存.           
            //思路：获取到用户输入的用户名，然后通过ajax发送给php,然后php肯定会响应结果回来。
            //最后ajax接受到结果，处理结果。
            // var usernameVal = $('input').val();//获取到input的value
 

            //$('input').nextAll('span')找到input后面所有的span标签
            $('input').nextAll('span').remove();

            //通过ajax将用户名发送给php
            $.post(
                "<?php echo U('Rbac/checkAdminExist');?>",//请求的php的路径
                {name: usernameVal},//要发送的数据，$_POST['name']

                //data可以拿到php响应回来的数据
                function (data) {
       
                    $('#user-name').attr('title', usernameVal);
                    if (data.code == 1200) {

                        // alert('用户已经存在');
                        $('#user-name').parent().after('<span style="color:red">用户已经存在</span>');

                    } 

                },
                'json'
            );
        }); 
jQuery(function($) {
        var oTable1 = $('#sample_table').dataTable( {
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
          //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
          {"orderable":false,"aTargets":[0,2,3,4,5,7,8,]}// 制定列不参与排序
        ] } );
                
                
                $('table th input:checkbox').on('click' , function(){
                    var that = this;
                    $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });
                        
                });
            
            
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
            });

</script>
<script type="text/javascript">
$(function() { 
    $("#administrator").fix({
        float : 'right',
        //minStatue : true,
        skin : 'green', 
        durationTime :false,
        spacingw:50,//设置隐藏时的距离
        spacingh:270,//设置显示时间距
    });
});

//初始化宽度、高度  
 $(".widget-box").height($(window).height()-215); 
$(".table_menu_list").width($(window).width()-260);
 $(".table_menu_list").height($(window).height()-215);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
    $(".widget-box").height($(window).height()-215);
     $(".table_menu_list").width($(window).width()-260);
      $(".table_menu_list").height($(window).height()-215);
    })
 laydate({
    elem: '#start',
    event: 'focus' 
});

/*用户-停用*/
function member_stop(obj,id,status){
    layer.confirm('确认要停用吗？',function(index){

       $.ajax({
            url: "<?php echo U('Rbac/editAdminStatus');?>",
            type: "post",
            data: "id="+id+"&pp="+status,
            success: function (msg) {

                if (msg['code'] == 1200) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,'+id+',2)" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 5,time:1000});
                   
                } else {

                    layer.msg('系统有误! 请尽快联系程序员!!',{icon:1,time:1000});
                }
            },
            dataType: "json"
        });
    });
}
/*用户-启用*/
function member_start(obj,id,status){
    layer.confirm('确认要启用吗？',function(index){

        $.ajax({
            url: "<?php echo U('Rbac/editAdminStatus');?>",
            type: "post",
            data: "id="+id+"&pp="+status,
            success: function (msg) {

                if (msg['code'] == 1200) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,'+id+',1)" href="javascript:;" title="停用"><i class="fa fa-check  bigger-120"></i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                } else {

                    layer.msg('系统有误! 请尽快联系程序员!!',{icon:1,time:1000});
                }
            },
            dataType: "json"
        });
    });
}
/*产品-编辑*/
// function member_edit(title,url,id,w,h){
//     layer_show(title,url,w,h);
// }

/*产品-删除*/
function del(obj, id) {

    layer.confirm('确认要删除吗？',function(index){

        $.ajax({
            url: "<?php echo U('Rbac/delAdminData');?>",
            type: "post",
            data: "id="+id,
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
/*添加管理员*/
$('#administrator_add').on('click', function(){
    layer.open({
    type: 1,
    title:'添加管理员',
    area: ['700px',''],
    shadeClose: false,
    content: $('#add_administrator_style'),
    
    });
})
    //表单验证提交
$("#form-admin-add").Validform({
        
         tiptype:2,
    
        callback:function(data){
        //form[0].submit();
        if(data.status==1){ 
                layer.msg(data.info, {icon: data.status,time: 1000}, function(){ 
                    location.reload();//刷新页面 
                    });   
            } 
            else{ 
                layer.msg(data.info, {icon: data.status,time: 3000}); 
            }         
            var index =parent.$("#iframe").attr("src");
            parent.layer.close(index);
            //
        }
        
        
    }); 




</script>