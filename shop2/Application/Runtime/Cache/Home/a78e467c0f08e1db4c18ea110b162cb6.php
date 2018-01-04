<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>支付完成页面</title>

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
	                <div class="md_process_wrap md_process_step4_5">
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
	        <div class="logo logo-cart" style="margin-left:50px;"></div>
	    </div>
	</div>

	<div class="cart_page_wrap" id="cartEmptyPage" style=""> 
		<div class="cart_empty"> 
			<div class="take-delivery">
			 <div class="status">
			   <h2>您已成功付款</h2>
			   <div class="successInfo">
			     <ul>
			       <li>付款金额<em>¥<?php echo ($info["total"]); ?></em></li>
			       <div class="user-info">
			         <p>收货人：<?php echo ($info["linkman"]); ?></p>
			         <p>联系电话：<?php echo ($info["phone"]); ?></p>
			         <p>收货地址：<?php echo ($info["address"]); ?></p>
			       </div>
			             请认真核对您的收货信息，如有错误请联系客服
			                               
			     </ul>
			     <div class="option">
			       <span class="info">您可以</span>
			        <a href="<?php echo U('Index/index');?>" class="J_MakePoint">返回<span>继续购买</span></a>
			        <a href="<?php echo U('Person/showOrderDetailView', ['id' => $info['id']]);?>" class="J_MakePoint">查看<span>交易详情</span></a>
			     </div>
			    </div>
			  </div>
			</div>
		</div> 
	</div>
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