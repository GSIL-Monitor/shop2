<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="/shop2/Public/myjs/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="/shop2/Public/myjs/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="/shop2/Public/myjs/css/jsstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/shop2/Public/myjs/js/address.js"></script>

    <link href="/shop2/Public/Home/__newtown/trade_cart_web/assets/mls-pc/pages/cartList/index.css-005591bf.css" rel="stylesheet" type="text/css"/>
	<link href="/shop2/Public/Home/css/index.css-dbb86485.css" rel="stylesheet" type="text/css"/>
	<link href="/shop2/Public/Home/css/index.css-63e7a9a6.css" rel="stylesheet" type="text/css"/>
    <link href="/shop2/Public/Home/css/index.css-edfa391a.css" rel="stylesheet" type="text/css"/>
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
	            <div class="md_process md_process_len4" style="margin-right:20px; padding:0px;">
							<div class="md_process_wrap md_process_step2_5"> 
							<div class="md_process_sd"></div> 
						<i class="md_process_i md_process_i1"> 1 <span class="md_process_tip">购物车</span> </i> 
						<i class="md_process_i md_process_i2"> 2 <span class="md_process_tip">确认订单</span> </i> 
						<i class="md_process_i md_process_i3"> 3 <span class="md_process_tip">支付</span> </i> 
						<i class="md_process_i md_process_i4"> <img src="https://s10.mogucdn.com/mlcdn/c45406/171012_12eba941iia4fajf729ked218cd8k_23x23.png" width="23" height="23" alt=""> <span class="md_process_tip">完成</span> </i> 
   					</div> 
   				</div> 
   			</div> 
   			<div class="logo logo-cart" style="margin-left:40px;"></div>
   		</div> 
	    </div>

	<div style="width:1200px; margin:0px auto; background-color:white; margin-top:20px;">
		<!--地址 -->
		
			<div class="address" style="margin-left:40px;">
				<h3>确认收货地址 </h3>
				<div class="control">
					<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
				</div>
				<div class="clear"></div>

			<?php if(is_array($data)): foreach($data as $key=>$vol): ?><ul class="listnumRess" mark="<?php echo ($vol["state"]); ?>">
					<div class="per-border"></div>
					<li class="user-addresslist">
						<div class="address-left">
							<div class="user DefaultAddr">
								<span class="buy-address-detail">   
	       						<span class="buy_user"><?php echo ($vol["name"]); ?></span>
								<span class="buy_phone"><?php echo ($vol["phone"]); ?></span>
								</span>
							</div>
							<div class="default-address DefaultAddr">
								<span class="buy-line-title buy-line-title-type">收货地址：</span>
								<span class="buy--address-detail">
								<span class="street"><?php echo ($vol["address"]); ?></span>
								</span>
							</div>
							<!-- <ins class="deftip">默认地址</ins> -->
						</div>
						<div class="clear"></div>

						<div class="new-addr-btn" style="width:100%">
						<!-- <ins class="deftip" style="margin-right:180px;width:65px;">默认地址</ins> -->
							<a href="#" class="hidden">默认地址</a>
							<span class="new-addr-bar hidden">|</span>
							<a href="<?php echo U('Person/address');?>">地址管理</a>
							<span class="new-addr-bar">|</span>
							<a href="javascript:void(0);" onclick="delClick(this, <?php echo ($vol["id"]); ?>);">删除</a>
						</div>

					</li>
				</ul><?php endforeach; endif; ?>
				<div class="clear"></div>
			</div>

			<!--订单 -->
				<div id="payTable" style="margin-top:40px;">
					<h3 style="margin-left:40px;">确认订单信息</h3>
					<div class="cart-table-th">
						<div class="wp" style="background-color:white; margin-bottom:10px;">

							<div class="th th-item" style="width:445px;font-size:16px">
								<div class="td-inner">商品</div>
							</div>
							<div class="th th-price" style="width:160px">
								<div class="td-inner">商品参数</div>
							</div>
							<div class="th th-price" style="width:160px">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount" style="width:160px">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-oplist">
								<div class="td-inner">配送方式</div>
							</div>

						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle-main">

						<?php if(is_array($info)): foreach($info as $key=>$vo): ?><ul class="item-content clearfix listnum" style="background-color:snow; width:1160px; margin:0px auto;">
								<div class="pay-phone">
									<li class="td td-item" style="width:450px;">
										<div class="item-pic">
											<a href="#" class="J_MakePoint">
												<img src="/shop2/Public/Uploads/<?php echo ($vo["pic"]); ?>" class="itempic J_ItemImg" style="width:100px;height:100px;"></a>
										</div>
										<div class="item-info" style="width:350px;">
											<div class="item-basic-info">
												<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo ($vo["name"]); ?></a>
											</div>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<span class="sku-line" style="display:block;margin-bottom:3px;width:100%;list-style:none;">颜色：&nbsp;<?php echo ($vo["color"]); ?></span>
												<span class="sku-line">尺寸：&nbsp;<?php echo ($vo["size"]); ?></span>
											</div>
										</div>
									</li>
								</div>
								<li class="td td-amount" style="width:210px;">
									<div class="amount-wrapper">
										<span><?php echo ($vo["price"]); ?></span>
									</div>
								</li>
								<li class="td td-sum" style="width:110px"> 
									<div class="td-inner">
										<em tabindex="0" class="J_ItemSum number"><?php echo ($vo["number"]); ?></em>
									</div>
								</li>
								<li class="td td-oplist" style="width:170px">
									<div class="pay-logis">
										<b class="sys_item_freprice"><?=number_format($vo['price']*$vo['number'], 2, '.', '')?></b>
									</div>
								</li>
								<li class="td td-oplist li_data_arr" style="width:70px" hidd="<?php echo ($vo["gid"]); ?>:<?php echo ($vo["cid"]); ?>:<?php echo ($vo["sid"]); ?>">
									<div class="td-inner">
										<span class="phone-title">配送方式</span>
										<div class="pay-logis spot" spot="<?php echo ($vo["spot"]); ?>">
											包邮
										</div>
									</div>
								</li>

							</ul><?php endforeach; endif; ?>
							<div class="clear"></div>

						</div>
					</tr>
					<div class="clear"></div>

					<div class="pay-total">
					<div class="order-extra">
						<div class="order-user-info">
							<div id="holyshit257" class="memo">
								<label>买家留言：</label>
								<input type="text" title="选填,定制类商品，请将购买需求在备注中详细说明" placeholder="选填：45字符内，定制类商品，请将购买需求在备注中详细说明" class="memo-input J_MakePoint c2c-text-default memo-close" maxlength="45">
								<div class="msg hidden J-msg">
									<p class="error">最多输入45个字符</p>
								</div>
							</div>
						</div>
					</div></div>

					<!--信息 -->
					<div class="order-go clearfix" style="margin-top:20px;">
					<?php if(empty($score)): else: ?>
					<div style="margin-right:40px"><input type="checkbox"/>你有<span id="score"><?php echo ($score); ?></span>积分，可兑现<span style="color:#ff3366" id="papa"><?php echo ($score/100); ?></span>元</div><br><?php endif; ?>
						<div class="pay-confirm clearfix showRess">
							<div class="box">
								<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
									<span class="price g_price ">
	                        <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">0.00</em>
									</span>
								</div>

								<div id="holyshit268" class="pay-address">

									<p class="buy-footer-address">
										<span class="buy-line-title buy-line-title-type">寄送至：</span>
										<span class="buy--address-detail">
										<span class="street"></span>
										</span>
										</span>
									</p>
									<p class="buy-footer-address">
										<span class="buy-line-title">收货人：</span>
										<span class="buy-address-detail">   
	                             		<span class="buy_user"> </span>
										<span class="buy_phone"></span>
										</span>
									</p>
								</div>
									<p id="inner" style="display:none;"> 
	                             		<i style="color:red;font-weight:bold">请选择地址!</i>
									</p>
							</div>

							<div id="holyshit269" class="submitOrder">
								<div class="go-btn-wrap">
									<a id="J_Go" href="javascript:;" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
								</div>
							</div>

							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>

<script>	

	var total = 0;
	for (var i = 0; i < $('.listnum').length; i++) {
		total += Number($('.listnum').eq(i).find('.sys_item_freprice').html());
	};

	$('.go-btn-wrap').click(function () {

		if ($('.user-addresslist').hasClass('defaultAddr') == true) {
			
			for (var i=0; i<$('.listnumRess').length; i++) {

				if ($('.listnumRess').eq(i).find('.user-addresslist').hasClass('defaultAddr') == true) {

					var name = $('.listnumRess').eq(i).find('.buy_user').html();
					var phone = $('.listnumRess').eq(i).find('.buy_phone').html();
					var address = $('.listnumRess').eq(i).find('.street').html();
					var spot = $('.spot').attr('spot');
				}
			}

			var data_arr  = new Array($('.listnum').length);
			for (var e=0; e<$('.listnum').length; e++) {

				data_arr[e] = $('.listnum').eq(e).find('.li_data_arr').attr('hidd');
			}
			var total = $('#J_ActualFee').html();
			var leave = $('input').val();
			var score = $('#score').html();
			if (!$('#J_ActualFee').attr('momo')) {
				momo = 2;		
			} else {
				momo = $('#J_ActualFee').attr('momo');
			}
			
			$.ajax({
				url: "<?php echo U('Order/handlerSubmitOrderData');?>",
				data: {data:data_arr, name:name, phone:phone, address:address, total:total, leave:leave, spot:spot, momo:momo, score:score},
				type: 'post',
				success: function (msg) {

					if (msg['code'] == 1200) {

						$(location).attr('href', "<?php echo U('Order/showDefrayView');?>?orderId="+msg.data);
					} else if (msg['code'] == 1404) {

						alert('系统有误, 程序员跑路....');
					}
				},
				dataType: 'json'
			});
		} else {

			$('#inner').css('display', 'block');
			return false;
		}
	});

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
	</div>


	<div class="theme-popover-mask"></div>
	<div class="theme-popover"	 style="height:410px">

		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
		</div>
		<hr/>

		<div class="am-u-md-12">
			<form class="am-form am-form-horizontal">

				<div class="am-form-group" style="margin-top:5px;">
					<label for="user-name" class="am-form-label">收货人</label>
					<div class="am-form-content">
						<input type="text" id="user_name" name="name" maxlength="10" placeholder="收货人姓名">
					</div>
					<div class="am-form-content heddin" style="visibility:hidden;">姓名必填</div>
				</div>

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">手机号码</label>
					<div class="am-form-content">
						<input id="user_phone" name="phone" placeholder="手机号必填" type="email">
					</div>
					<div class="am-form-content heddin" style="visibility:hidden;">1</div>
				</div>

				<div class="am-form-group aaadiv">
					<label for="user-phone" class="am-form-label">所在地</label>
					<div class="am-form-content address" id="outer">
						<select data-am-selected name="pro" id="pro">
							<option value="0">--请选择--</option>
						</select>
					</div>
				</div>
				<div class="am-form-content heddin selectHidden" style="visibility:hidden;">所在地必填</div>	

				<div class="am-form-group">
					<label for="user-intro" class="am-form-label">详细地址</label>
					<div class="am-form-content">
						<textarea class="" rows="3" id="user_intro" name="intro" maxlength="35" placeholder="35字以内写出你的详细地址..."></textarea>
					</div>
					<div class="am-form-content heddin" style="visibility:hidden;">详细地址必填</div>	
				</div>

				<div class="am-form-group theme-poptit">
					<div class="am-u-sm-9 am-u-sm-push-3">
						<div class="am-btn am-btn-danger" id="submitInner">保存</div>
						<input class="am-btn am-btn-danger close" type="reset" value="取消" />
					</div>
				</div>
			</form>
		</div>
	<div class="clear"></div>
	</div>
	</body>
</html>

<script>

	function delClick(obj, id) {

		$.ajax({
			url: "<?php echo U('Person/delAddressData');?>",
			data: "id="+id,
			type: "post",
			success: function (msg) {

				if (msg.code == 1200) {

					$(obj).parents('li').remove()
				} else {

					// 程序员修复中.....
				}
			},
			dataType: 'json'
		});
	}

	for (var i=0; i<$('.listnumRess').length; i++) {

		if ($('.listnumRess').eq(i).attr('mark') =='1') {

			$('.listnumRess').eq(i).find('.user-addresslist').addClass('defaultAddr');
			$('.listnumRess').eq(i).find('.new-addr-btn').prepend('<ins class="deftip" style="margin-right:180px;width:65px;">默认地址</ins>');

			var name = $('.listnumRess').find('.buy_user').html();
			var phone = $('.listnumRess').find('.buy_phone').html();
			var address = $('.listnumRess').find('.street').html();
			
			$('.showRess').find('.street').html(address);
			$('.showRess').find('.buy_user').html(name);
			$('.showRess').find('.buy_phone').html(phone);
		}
	}

	$('.listnumRess').click(function () {

		$('#inner').css('display', 'none');
		$(this).find('.user-addresslist').addClass('defaultAddr');
		$(this).siblings().find('.user-addresslist').removeClass('defaultAddr');

		var name = $(this).find('.buy_user').html();
		var phone = $(this).find('.buy_phone').html();
		var address = $(this).find('.street').html();
		
		$('.showRess').find('.street').html(address);
		$('.showRess').find('.buy_user').html(name);
		$('.showRess').find('.buy_phone').html(phone);
	});

	$('input[type="reset"]').click(function () {

		$('.heddin').css('visibility', 'hidden');
	})

	$('#user_phone').blur(function () {

		var phone = $(this).val();
		if (phone.length == 0) {
			$(this).parent().next().html('手机号码必填').css({'visibility':'visible', 'color': 'red'});
		}else if(!(/^1[34578]\d{9}$/.test(phone))) { 
	        $(this).parent().next().html('手机号码格式有误, 请重填').css({'visibility':'visible', 'color': 'red'});
	    } else {
	    	$(this).parent().next().css('visibility','hidden');
	    }
	})

	$('#user_name').blur(function () {

		var name = $(this).val();
		if (name.length != 0) {
			$(this).parent().next().css('visibility','hidden');
		}
	})

	$('#user_intro').blur(function () {

		var ress = $(this).val();
		if (ress.length != 0) {
			$(this).parent().next().css('visibility','hidden');
		}
	})

	$('select[name="area"]').change(function () {
		var area = $(this).val();
		if (area != 0) {
			$('.selectHidden').css('visibility','hidden');
		}
	})

	$('#submitInner').click(function () {

		var phone = $('#user_phone').val();
		var name = $('#user_name').val();
		var pro = $('select[name="pro"]').val();
		var city = $('select[name="city"]').val();
		var area = $('select[name="area"]').val();
		var ress = $('#user_intro').val();

		if (name.length == 0) {
			$('#user_name').parent().next().css({'visibility':'visible', 'color': 'red'});
			return false;
		} else {
			$('#user_name').parent().next().css('visibility','hidden');
		}

		if (phone.length == 0) {
			$('#user_phone').parent().next().html('手机号码必填').css({'visibility':'visible', 'color': 'red'});
		}else if(!(/^1[34578]\d{9}$/.test(phone))) { 
	        $('#user_phone').parent().next().html('手机号码格式有误, 请重填').css({'visibility':'visible', 'color': 'red'});
	    } else {
	    	$('#user_phone').parent().next().css('visibility','hidden');
	    }

		if (typeof(area) == "undefined" || area == 0) {
			console.log(123123);
			$('.aaadiv').next().css({'visibility':'visible', 'color': 'red'});
			return false;
		} else {
			$('.selectHidden').css('visibility','hidden');
		}

		if (ress.length == 0) {
			$('#user_intro').parent().next().css({'visibility':'visible', 'color': 'red'});
			return false;
		} else {
			$('#user_intro').parent().next().css('visibility','hidden');
		}

        var data = $('form').serialize();
		$.ajax({
			url: "<?php echo U('Order/handlerAddress');?>",
			data: data,
			type: 'post',
			success: function (msg) {

				if (msg['code'] == 1200) {

					location.reload();
				} else {

					// 联系程序员中....
				}
			},
			dataType: 'json'
		});
	});
	
	$('#J_ActualFee').html(parseFloat(total).toFixed(2));

	//拿省份的数据
	$.post(
		"<?php echo U('Order/getAddressData');?>",
		function (msg) {
			
			if (msg.code == 1200) {

				var optionStr = '';
				for (var i = 0; i<msg.data.length; i++) {
					optionStr += '<option value="'+ msg.data[i].id +'">'+ msg.data[i].name +'</option>';
				}

				$('select#pro').append( optionStr );
			}
		},
		'json'
	);

	var config = {

		pro: 'city',//市区
		city: 'area',//区
		area: 'stree',//街道
	};

	$('#outer').on('change', 'select', function () {

		$(this).nextAll('select').remove();
		if ($('#outer select').length >= 3) {

			return false;
		}
		var id = $(this).val();

		var currentName = $(this).attr('name');

		$.get(
			"<?php echo U('Order/getAddressData');?>",
			{upid: id},
			function (msg) {
				
				if (msg.code == 1200) {

					var optionStr = '<select data-am-selected name="'+ config[currentName] +'">';
					optionStr += '<option value="0">--请选择--</option>';
					for (var i = 0; i<msg.data.length; i++) {
						optionStr += '<option value="'+ msg.data[i].id +'">'+ msg.data[i].name +'</option>';
					}

					optionStr += '</select>';

					$('#outer').append( optionStr );
				}
			},
			'json'
		);
	});

$(function(){
    $('input:checkbox').on('change', function(){

        if($('input:checkbox:checked').val()) {

            var total = $('#J_ActualFee').html();
            $('#J_ActualFee').attr('box',total);
            var num = $('#papa').html();
            console.log(total);
            console.log(num);
            total = total - num;
           $('#J_ActualFee').html(total);
           $('#J_ActualFee').attr('momo',1);


        } else {
    
       total = $('#J_ActualFee').attr('box');
       		$('#J_ActualFee').attr('momo',null);
           $('#J_ActualFee').html(total);

        }
    })
});
</script>