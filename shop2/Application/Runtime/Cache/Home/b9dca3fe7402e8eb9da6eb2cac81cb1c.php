<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>支付页面</title>

		<link href="/shop2/Public/myjs/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/css/optstyle.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" src="/shop2/Public/myjs/js/jquery.js"></script>
<link href="/shop2/Public/myjs/css/sustyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet"  type="text/css" href="/shop2/Public/myjs/AmazeUI-2.4.2/assets/css/amazeui.css"/>
<link href="/shop2/Public/myjs/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/shop2/Public/myjs/basic/css/demo.css" rel="stylesheet" type="text/css" />
	<script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
    <link href="/shop2/Public/Home/css/index.css-dbb86485.css" rel="stylesheet" type="text/css"/>
    <link href="/shop2/Public/Home/__newtown/trade_cart_web/assets/mls-pc/pages/cartList/index.css-005591bf.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/shop2/Public/Home/js/pkg-pc-base.js-beb518b8.js"></script>
	</head>

	<body>

	<div id="header" class="J_sitenav header_2015" data-ptp="_head">
	    <div class="wrap clearfix"><a href="<?php echo U('index/index');?>" rel="nofollow" class="home fl">美丽说首页</a>
	    	<ul class="header_top">
	    		<li class="s1 has_icon user_meta">

	    			<?php if($_SESSION['user:data']): ?><a rel="nofollow" href="<?php echo U('person/index');?>"><?php echo ($_SESSION['user:data']['account']); ?></a>
	    			<?php else: ?>
					<a rel="nofollow" href="<?php echo U('login/index');?>">登录</a><?php endif; ?>
	    			<a rel="nofollow" href="javascript:;" target="_blank"></a><ol class="ext_mode" id="menu_personal">
	    		</ol></li>
	    		<li class="s1 has_icon has_line user_fav"><a rel="nofollow" href="javascript:;">我的收藏</a><i class="icon_delta"></i>
	    	<ul class="ext_mode">
	    		<li class="s2"><a target="_blank" rel="nofollow" href="javascript:;">收藏宝贝</a></li><li class="s2"><a target="_blank" rel="nofollow" href="javascript:;">收藏店铺</a></li>
	    	</ul></li>

	    		<li class="s1 myorder has_line"><a href="<?php echo U('person/showOrderView');?>" target="_blank" class="text display_u" ref="nofollow">我的订单</a></li>
	    		<li class="s1 has_line shopping_cart_v2"><a class="cart_info_wrap" href="<?php echo U('cart/showMyCartView');?>" target="_blank" ref="nofollow"><span class="cart_info">购物车(<?php echo ($count); ?>)</span></a><i class="icon_delta"></i><span class="shopping_cart_loading"></span></li>
	    		</ul></div>
	</div>

	<div id="body_wrap">
        <div class="g-header clearfix">
	    <div class="g-header-in wrap clearfix">
	        <div class="process-bar">
	            <div class="md_process md_process_len4">
	                <div class="md_process_wrap md_process_step3_5">
	                    <div class="md_process_sd"></div>
	                    <i class="md_process_i md_process_i1">
	                        1                <span class="md_process_tip">购物车</span>
	                    </i>
	                    <i class="md_process_i md_process_i2">
	                        2                <span class="md_process_tip">确认订单</span>
	                    </i>
	                    <i class="md_process_i md_process_i3">
	                        3                <span class="md_process_tip">支付</span>
	                    </i>
	                    <i class="md_process_i md_process_i4">
	                        <img src="https://s10.mogucdn.com/mlcdn/c45406/171012_12eba941iia4fajf729ked218cd8k_23x23.png" width="23" height="23" alt="">
	                        <span class="md_process_tip">完成</span>
	                    </i>
	                </div>
	            </div>        </div>
	        <a href="" class="logo logo-cart" style="margin-left:50px;"></a>
	    </div>
	</div>

	<div class="cart_page_wrap" id="cartEmptyPage" style=""> 
		<div class="cart_empty"> 
	<div class="cart_empty_icon" style="margin-left:-200px"></div>
	 <div class="status" style="margin-left:170px; margin-top:20px; cursor: pointer; ">
	   <h2 style="font-size:16px;">订单生成成功，请在24小时内支付~</h2>
	   <div class="successInfo">
	     <ul>
	       <li>金额：<em style="font-size:20px;text-decoration:line-through;">¥<?php echo ($data["total"]); ?></em></li>
		
			
			<?php  $discount = M('user_discount')->where(['role' => $_SESSION['user:data']['role']])->getField('discount'); ?>

			<?php if($_SESSION['user:data']['role'] == 1): ?><li>普通会员价：<em style="font-size:20px;">¥<i class="total_data"><?=number_format($data['total']*$discount, 2)?></i></em></li>
			<?php elseif($_SESSION['user:data']['role'] == 2): ?>
			<li>VIP会员价：<em style="font-size:20px;">¥<i class="total_data"><?=number_format($data['total']*$discount, 2)?></i></em></li>
			<?php elseif($_SESSION['user:data']['role'] == 3): ?>
			<li>钻石会员价：<em style="font-size:20px;">¥<i class="total_data"><?=number_format($data['total']*$discount,2)?></i></em></li><?php endif; ?>

	       <li>订单号：<em style="font-size:20px;"><?php echo ($data["id"]); ?></em></li>
	        <li>
				<a href="javascript:;" id="defray" class="btn-area submit-btn submit-btn-disabled" style="width:130px; color:white;" id="outer">
					立&nbsp;即&nbsp;支&nbsp;付
				</a>
	        </li> 
	     </ul>              
    </div>
  </div>
		</div> 
	</div>

<script>
	$('#defray').click(function () {

		var id = $('em').last().html();
		var total = $('.total_data').html();

		$.ajax({
			url: "<?php echo U('person/handlerDelOrders');?>",
			data: "id="+id+"&spot="+total,
			type: 'post',
			success: function (msg) {

				if (msg.code == 1200) {

					$(location).attr('href', "<?php echo U('Order/showSuccessView');?>?orderId="+id);
				}
			},
			dataType: 'json'
		})
	})
</script>

	<div class="g-footer">
    <p title="hello">
        <a href="javascript:;" target="_blank">美丽说</a>
         © 2016 Meilishuo.com,All Rights Reserved.
    </p>
    <div class="icons">
        <a class="vs" href="javascript:;"></a>
        <a class="mc" href="javascript:;"></a>
        <a class="up" href="javascript:;"></a>
        <a class="pa" href="" target="_blank"></a>
        <a class="kx" href="" target="_blank"></a>
        <a class="pc" href="" target="_blank"></a>
    </div>
</div>