<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		<script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
    <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/shop2/Public/js/H-ui.js"></script>      	
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
    <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/shop2/Public/assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>
<title>订单详细</title>
</head>

<body>
<div class="margin clearfix">
<div class="Order_Details_style">
<div class="Numbering">订单编号:<b><?php echo ($ressData['id']); ?></b></div></div>
 <div class="detailed_style">
 <!--收件人信息-->
    <div class="Receiver_style">
     <div class="title_name">收件人信息</div>
     <div class="Info_style clearfix">
        <div class="col-xs-6">  
         <label class="label_name" for="form-field-2"> 收件人姓名： </label>
         <div class="o_content"><?php echo ($ressData['linkman']); ?></div>
        </div>
        <div class="col-xs-4">  
         <label class="label_name" for="form-field-2"> 收件人电话： </label>
         <div class="o_content"><?php echo ($ressData['phone']); ?></div>
        </div>
         <div class="col-xs-9">  
         <label class="label_name" for="form-field-2"> 收件地址： </label>
         <div class="o_content"><?php echo ($ressData['address']); ?></div>
        </div>
     </div>
    </div>
    <!--订单信息-->
    <div class="product_style">
    <div class="title_name">产品信息</div>
    <div class="Info_style clearfix">

<?php if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><div class="product_info clearfix listnum">
      <a href="#" class="img_link"><img src="/shop2/Public/Uploads/<?php echo ($vo["pic"]); ?>"  width="200" height="200"/></a>
      <p style="margin-bottom:20px;"><?php echo ($vo["name"]); ?></p>
      <p style="display:block;">规格：<?php echo ($vo["color"]); ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo ($vo["size"]); ?></p>
      <p>数量：<i class="number"><?php echo ($vo["num"]); ?></i></p>
      <p>价格：<b class="price"><i>￥</i><?php echo ($vo["price"]); ?></b></p>    
      </div><?php endforeach; endif; ?>
    </div>
    </div>
    <!--总价-->
    <div class="Total_style">
     <div class="Info_style clearfix">
      <div class="col-xs-1">  
        </div>
        <div class="col-xs-5">  
         <label class="label_name" for="form-field-2"> 支付状态： </label>
         <div class="o_content">
          
          <?php if($ressData['status'] == 1): ?>等待付款
          <?php elseif($ressData['status'] == 2): ?> 等待发货
          <?php elseif($ressData['status'] == 3): ?> 等待收货
          <?php elseif($ressData['status'] == 4): ?> 已完成
          <?php elseif($ressData['status'] == 6): ?> 已完成
          <?php elseif($ressData['status'] == 5): ?>已过期<?php endif; ?>
            
        </div>
        </div>
        <div class="col-xs-5">  
         <label class="label_name" for="form-field-2"> 订单生成日期： </label>
         <div class="o_content"><?php echo ($ressData['addtime']); ?></div>
        </div>
        </div>
      <div class="Total_m_style"><span class="Total">总数：<b class="total_number">0</b></span><span class="Total_price">总价：<b><?php echo ($ressData['total']); ?></b>元</span></div>
    </div>
<div class="Button_operation">
				<a href="<?php echo U('order/showOrderBoardView');?>" class="btn btn-primary radius" type="submit"><i class="icon-save "></i>返回上一步</a>
			</div>
 </div>
</div>
</body>
</html>
<script>

    var number = 0;
    for (var i=0; i<$('.listnum').length; i++) {

        number += Number($('.listnum').eq(i).find('.number').html());
    }
    $('.total_number').html(number);
</script>