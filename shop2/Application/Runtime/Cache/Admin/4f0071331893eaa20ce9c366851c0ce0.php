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
    <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
    <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/shop2/Public/js/H-ui.js"></script>     
    <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>            
    <script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
    <script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
    <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/shop2/Public/assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>

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
    /*background: url('../images/bottom_bg.png') 0px 0px;*/ 
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

<title>订单管理</title>
</head>

<body>
<div class="page-content clearfix">
  <div id="brand_style">
    <div class="search_style">
      <div class="title_names">搜索查询</div>
      <ul class="search_content clearfix">
      <form action="JavaScript:;" method="get">
         <li><label class="l_f">订单号</label><input name="" type="text"  class="text_add" placeholder="输入订单号"  style=" width:250px"/></li>
         <li style="width:90px;"><button type="submit" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </form>
      </ul>
    </div>
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('order/showOrderBoardView', ['status' => '']);?>" class="btn btn-info">全部订单(&nbsp;<?php echo ($counts[6]); ?>&nbsp;)</a>
        <a href="<?php echo U('order/showOrderBoardView', ['status' => 1]);?>" class="btn btn-warning Order_form">&nbsp;待支付(&nbsp;<?php echo ($counts[0]); ?>&nbsp;)</a>
        <a href="<?php echo U('order/showOrderBoardView', ['status' => 2]);?>" class="btn btn-danger">&nbsp;代发货(&nbsp;<i id="shipper"><?php echo ($counts[1]); ?></i>&nbsp;)</a>
        <a href="<?php echo U('order/showOrderBoardView', ['status' => 3]);?>" class="btn btn-Teal">&nbsp;待收货(&nbsp;<i id="consignee"><?php echo ($counts[2]); ?></i>&nbsp;)</a>
        <a href="<?php echo U('order/showOrderBoardView', ['status' => 4]);?>" class="btn btn-success">&nbsp;待评价(&nbsp;<?php echo ($counts[3]); ?>&nbsp;)</a>
        <a href="<?php echo U('order/showOrderBoardView', ['status' => 6]);?>" class="btn btn-success">&nbsp;已完成(&nbsp;<?php echo ($counts[5]); ?>&nbsp;)</a>
        <a href="<?php echo U('order/showOrderBoardView', ['status' => 5]);?>" class="btn btn-yellow">过期订单(&nbsp;<?php echo ($counts[4]); ?>&nbsp;)</a>
       </span>

     </div>
     <div class="pagination">
    　　<ul>
            <li><?php echo ($btn); ?></li>
        </ul>
  </div>
     <!--品牌列表-->
      <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
    <thead>
     <tr>
        <th width="100px">订单号</th>
        <th width="230px">商品</th>
        <th width="120px">总价</th>
        <th width="130px">订单时间</th>
        <th width="100px">数量</th>
        <th width="70px">状态</th>                
        <th width="200px">操作</th>
      </tr>
    </thead>
  <tbody>

  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
     <td><?php echo ($vo["id"]); ?></td>

<?php
 $pic = M('order_detail')->field('pic')->where(['oid' => $vo['id']])->find(); ?>
     <td class="order_product_name">
      <a href="javascript:;"><img src="/shop2/Public/Uploads/<?php echo ($pic["pic"]); ?>" title="产品名称" style="width:60px;height:60px;" /></a>
     </td>
     <td><?php echo ($vo["total"]); ?></td>
     <td><?php echo ($vo["addtime"]); ?></td>

<?php
 $num = M('order_detail')->field('num')->where(['oid' => $vo['id']])->select(); $number = 0; for ($i=0; $i < count($num); $i++) { $number += $num[$i]['num']; } ?>
     <td><?php echo ($number); ?></td>
      <td class="td-status"><span class="label label-success radius">

          <?php if($vo["status"] == 1): ?>待支付
          <?php elseif($vo["status"] == 2): ?> 代发货
          <?php elseif($vo["status"] == 3): ?> 待收货
          <?php elseif($vo["status"] == 4): ?> 已完成
          <?php elseif($vo["status"] == 5): ?> 已过期
          <?php elseif($vo["status"] == 6): ?> 已完成<?php endif; ?>
          </span>
      </td>
     <td>
     <?php if($vo["status"] == 2): ?><a onClick="Delivery_stop(this,<?php echo ($vo["id"]); ?>)"  href="javascript:;" title="发货"  class="btn btn-xs btn-success"><i class="fa fa-cubes bigger-120"></i></a><?php endif; ?>
     <a title="订单详细"  href="<?php echo U('order/showOrderDetailView', ['id' => $vo['id']]);?>"  class="btn btn-xs btn-info order_detailed"><i class="fa fa-list bigger-120"></i></a>
     <a title="删除" href="javascript:;" onclick="Order_form_del(this,<?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-warning"><i class="fa fa-trash bigger-120"></i></a>    
     </td>
     </tr><?php endforeach; endif; ?>

        </tbody>
        </table>
        </div>
     </div>
    
  </div>
</div>

 <!--发货-->
 <div id="Delivery_stop" style=" display:none">
  <div class="">
    <div class="content_style">
  <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">快递公司 </label>
       <div class="col-sm-9"><select class="form-control" id="form-field-select-1">
                                <option value="">--选择快递--</option>
                                <option value="1">天天快递</option>
                                <option value="2">圆通快递</option>
                                <option value="3">中通快递</option>
                                <option value="4">顺丰快递</option>
                                <option value="5">申通快递</option>
                                <option value="6">邮政EMS</option>
                                <option value="7">邮政小包</option>
                                <option value="8">韵达快递</option>
                              </select></div>
  </div>
   <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 快递号 </label>
    <div class="col-sm-9"><input type="text" id="form-field-1" placeholder="快递号" class="col-xs-10 col-sm-5" style="margin-left:0px;"></div>
  </div>
 </div>
  </div>
 </div>
</body>
</html>
<script>

/*订单-删除*/
function Order_form_del(obj,id){
  layer.confirm('确认要删除吗？',function(index){

    $.ajax({
        url: "<?php echo U('Order/handlerDelOrder');?>",
        data: "id="+id,
        type: "post",
        success: function (msg) {

            if (msg.code == 1200) {

                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            } else {

                layer.msg('系统有误，请尽快联系程序员!',{icon:2,time:1000});
            }
        },
        dataType: 'json'
    })
    
  });
}

/**发货**/
function Delivery_stop(obj,id){
  layer.open({
        type: 1,
        title: '发货',
    maxmin: true, 
    shadeClose:false,
        area : ['500px' , ''],
        content:$('#Delivery_stop'),
    btn:['确定','取消'],
    yes: function(index, layero){   
    if($('#form-field-1').val()==""){
      layer.alert('快递号不能为空！',{
               title: '提示框',        
        icon:0,   
        }) 

    }else{      

      $.ajax({
        url: "<?php echo U('Order/handlerShipperData');?>",
        data: "id="+id,
        type: 'post',
        success: function (msg) {

            if (msg.code == 1200) {

               var consignee = Number($('#consignee').html());
               var shipper = Number($('#shipper').html());
               $('#consignee').html(consignee+1);
               $('#shipper').html(shipper-1);

                $(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发货</span>');
                $(obj).remove();
                layer.msg('已发货!',{icon: 6,time:1000});
                layer.close(index);  
            } else {

                layer.msg('系统有误，请尽快联系程序员!',{icon: 2,time:1000});
            }
        },
        dataType: 'json'
      });      
      }
    }
  });
};


</script>