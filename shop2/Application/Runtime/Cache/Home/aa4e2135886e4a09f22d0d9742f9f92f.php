<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="/shop2/Public/myjs/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/shop2/Public/myjs/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/shop2/Public/myjs/js/jquery.js"></script>

	<script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
    <link href="/shop2/Public/Home/css/index.css-dbb86485.css" rel="stylesheet" type="text/css"/>
    <link href="/shop2/Public/Home/__newtown/trade_cart_web/assets/mls-pc/pages/cartList/index.css-005591bf.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/shop2/Public/Home/js/pkg-pc-base.js-beb518b8.js"></script>
    <style>
		#outer:hover{
			color:#fff;
		}
    </style>
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
	    		<li class="s1 has_line shopping_cart_v2"><a class="cart_info_wrap" href="<?php echo U('cart/showMyCartView');?>" target="_blank" ref="nofollow"><span class="cart_info">购物车</span></a><i class="icon_delta"></i><span class="shopping_cart_loading"></span></li>
	    		</ul></div>
	</div>

	<div id="body_wrap">
        <div class="g-header clearfix">
	    <div class="g-header-in wrap clearfix">
	        <div class="process-bar">
	            <div class="md_process md_process_len4">
	                <div class="md_process_wrap md_process_step1_5">
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
	                        4
	                        <span class="md_process_tip">完成</span>
	                    </i>
	                </div>
	            </div>        </div>
	        <a href="<?php echo U('Index/index');?>" class="logo logo-cart" style="margin-left:50px;"></a>
	    </div>
	</div>

	<?php
 if (empty($cartData)) { ?>
	
	<div class="cart_page_wrap" id="cartEmptyPage" style=""> 
		<div class="cart_empty"> 
			<div class="cart_empty_icon"></div> 
			<h5 class="mb20" style="margin-right:400px;">您的购物车还是空的，赶快去挑选商品吧！</h5> 
			<ul class="cart_empty_list" style="margin-top:30px; margin-left:190px;"> 
				<li>去看看大家都喜欢的<a href="" class="cart_red cart_uline">最热</a></li> 
				<li>去看看正在折扣中的优品<a href="" class="cart_red cart_uline">首页</a></li> 
			</ul> 
		</div> 
	</div>

	<?php } else {?>
	
	<div class="cart_page_wrap" id="cartEmptyPage" style="display:none;"> 
		<div class="cart_empty"> 
			<div class="cart_empty_icon"></div> 
			<h5 class="mb20" style="margin-right:400px;">您的购物车还是空的，赶快去挑选商品吧！</h5> 
			<ul class="cart_empty_list" style="margin-top:30px; margin-left:190px;"> 
				<li>去看看大家都喜欢的<a href="" class="cart_red cart_uline">最热</a></li> 
				<li>去看看正在折扣中的优品<a href="" class="cart_red cart_uline">首页</a></li> 
			</ul> 
		</div> 
	</div>

	<div id="cart_body" style="display:block;">
	<div class="g-wrap wrap" style="width:1160px; margin:0px auto; height:70px;">
	    <div class="clearfix cart_slide pb20" id="cartSlide">
	        <li>
	            <a href="javascript:;" class="mr10 cart_slide_item cartSlideItemAll cart_slide_item_cur  {{?it.tabItemNum.allItemNum<=0}}cart_slide_not_allowed{{?}}">
	                全部商品 (<span class="num_all"><?=count($cartData)?></span>)
	            </a>
	        </li>
	    </div>
    </div>
	<!--购物车 -->
	<div>
		<div style="width:1160px; margin:0px auto ;">
			<div class="cart-table-th">
				<div  class="float-bar-wrapper" style="background-color:WHITE;">
					<div class="th th-chk">
						<div id="J_SelectAll1" class="select-all J_SelectAll">

						</div>
					</div>
					<div class="th th-price" style="margin-right:195px; margin-left:80px;">
						<div class="td-inner">商品</div>
					</div>
					<div class="th th-price" style="margin-right:30px;">
						<div class="td-inner">商品信息</div>
					</div>
					<div class="th th-price">
						<div class="td-inner">单价</div>
					</div>
					<div class="th th-amount">
						<div class="td-inner">数量</div>
					</div>
					<div class="th th-sum">
						<div class="td-inner">金额</div>
					</div>
					<div class="th th-op">
						<div class="td-inner">操作</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>

			<tr class="item-list">
				<div class="bundle  bundle-last ">
					<div class="clear"></div>
					<div class="bundle-main">

				<?php if(is_array($cartData)): foreach($cartData as $key=>$vo): ?><ul class="item-content clearfix listsum">
							<li class="td td-chk">
								<div class="cart-checkbox ">
									<input class="check" xue="<?php echo ($vo['gid']); ?>:<?php echo ($vo['cid']); ?>:<?php echo ($vo['sid']); ?>" id="J_CheckBox_170037950254" name="items" type="checkbox" onclick="check_btn(this)"> 
									<label for="J_CheckBox_170037950254"></label>
								</div>
							</li>
							<li class="td td-item" style="width:40%;">
								<div class="item-pic">
									<a href="<?php echo U('Goods/showDetailView', ['id' => $vo['gid']]);?>" target="_blank" class="J_MakePoint" data-point="tbcart.8.12">
										<img src="/shop2/Public/Uploads/<?php echo ($vo["pic"]); ?>" style="width:100px;height:100px;">
									</a>
								</div>
								<div class="item-info">
									<a title="<?php echo ($vo["name"]); ?>">
										<div class="item-basic-info" style="height:100px;">
											<i target="_blank"  class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo ($vo["name"]); ?></i>
										</div>
									</a>
								</div>
							</li>
							<li class="td td-info" style="width:10%;">
								<div>
									<span class="sku-line" style="display:block; margin-top:18px;margin-bottom:3px;">颜色：&nbsp;<?php echo ($vo["color"]); ?></span>
									<span class="sku-line">尺寸：&nbsp;<?php echo ($vo["size"]); ?></span>
								</div>
							</li>
							<li class="td td-price">
								<div class="item-price price-promo-promo">
									<div class="price-content">
										<div class="price-line" style="margin-top:5px;">
											<em class="J_Price price-now" id="em-tag" tabindex="0"><?php echo ($vo["price"]); ?></em>
										</div>
									</div>
								</div>
							</li>
							<li class="td td-amount">
								<div class="amount-wrapper ">
									<div class="item-amount ">
										<div class="sl" style="margin-left:17px;">
											<input class="am-btn" min="1" style="height:25px;" onclick="cut(this, <?php echo ($vo['gid']); ?>, <?php echo ($vo['cid']); ?>, <?php echo ($vo['sid']); ?>)" type="button" value="-" />
											<input class="text_box" xiao="&uid=<?php echo ($vo["gid"]); ?>&cid=<?php echo ($vo['cid']); ?>&sid=<?php echo ($vo['sid']); ?>" style="width:40px; height:24.5px; text-align:center;" name="num" type="text" value="<?php echo ($vo["number"]); ?>" style="width:30px;" />
											<input class="am-btn" id="addNumber" numberData="" style="height:25px;" onclick="add(this, <?php echo ($vo['gid']); ?>, <?php echo ($vo['cid']); ?>, <?php echo ($vo['sid']); ?>)" type="button" value="+" />
										</div>
									</div>
								</div>
							</li>
							<li class="td td-sum">
								<div class="td-inner" style="margin-left:15px;">
									<em tabindex="0" class="J_ItemSum number" id="summary"><?=number_format($vo['price']*$vo['number'], 2, '.', '')?></em>
								</div>	
							</li>
							<li class="td td-op">
								<div class="td-inner">
									<a title="移入收藏夹" id="keep_click" ke="<?php echo ($vo['gid']); ?>:<?php echo ($vo['cid']); ?>:<?php echo ($vo['sid']); ?>" class="btn-fav" href="#">移入收藏夹</a>
									<a href="javascript:;" onclick="delete_btn(this, <?php echo ($vo['gid']); ?>, <?php echo ($vo['cid']); ?>, <?php echo ($vo['sid']); ?>)" class="delete">删除</a>
								</div>
							</li>
						</ul><?php endforeach; endif; ?>

					</div>
				</div>
			</tr>
		</div>
		<div class="clear"></div>

		<div class="float-bar-wrapper" style="width:1160px; margin:0px auto; background-color:white;">
			<div id="J_SelectAll2" class="select-all J_SelectAll">
				<div class="cart-checkbox">
					<input id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
					<label for="J_SelectAllCbx2"></label>
				</div>
				<span>全选</span>
			</div>
			<div class="operations">
				<a href="javascript:;" class="deleteAll">删除</a>
				<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
			</div>
			<div class="float-bar-right" style="background-color:white;border:1px solid #D8BFD8;">
				<div class="amount-sum">
					<span class="txt">已选商品</span>
					<em id="J_SelectedItemsCount"><?=empty($cartData)?0:1?></em><span class="txt">件</span>
					<div class="arrow-box">
						<span class="selected-items-arrow"></span>
						<span class="arrow"></span>
					</div>
				</div>
				<div class="price-sum">
					<span class="txt" id="priceAll">合计:</span>
					<strong class="price">¥<em id="J_Total">0.00</em></strong>
				</div>
				<a id="J_Go" class="submit-btn submit-btn-disabled">
					<div class="btn-area" style="width:130px" id="outer" style="background-color:#ff3366">
						结&nbsp;算
					</div>
				</a>
			</div>
		</div>
	</div>
	</div>
	<?php }?>

<script>

	$('#J_Go').click(function () {
	    
	    var num = 0;
	    var data_arr = new Array($('.listsum').length);
	    for (var i=0; i<$('.listsum').length; i++) {

	    	if ($('.listsum').eq(i).find('#J_CheckBox_170037950254').attr('checked') == 'checked') {

	    		var data = $('.listsum').eq(i).find('#keep_click').attr('ke');
				data_arr[i] = data;
				num++;
			}
	    }

	    if (num <= 0) {

	    	$(this).attr('title', '至少选一件商品哟~');
	    	return false;
	    }

	    $.ajax({
	    	type: 'post',
	    	url:  "<?php echo U('Order/handlerCartAjaxData');?>",
	    	data: {data:data_arr},
	    	success: function (msg) {

	    		if (msg['code'] == 1404) {

	    			layer.confirm('您尚未登录, 请确认登录~', {
			            btn : [ '确定' , '取消']//按钮
			        }, function(index) {
			            layer.close(index);
			            $(location).attr('href', "<?php echo U('Login/index');?>");
			        }); 
					return false;
	    		}

	    		if (msg['code'] == 1606) {

	    			for (var i=0; i<$('.listsum').length; i++) {

	    				if ($('.listsum').eq(i).find('#keep_click').attr('ke') == msg['id']) {

	    					$('.cutadd_div').remove();
	    					$('.listsum').eq(i).find('#addNumber').after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">该商品已售空~</div>');
	    				}
	    			}
	    		}

	    		if (msg['code'] == 1200) {

	    			$(location).attr('href', "<?php echo U('Order/showOrderView');?>?arr="+data_arr);
	    		}
	    	},
	    	dataType: 'json'
	    });
	})
				
	// 多条删除操作
	$('.deleteAll').click(function () {

		var strRes = 0;
        var data_arr = new Array($('.listsum').length);
		for (var i = 0; i<$('.listsum').length; i++) {

			if ($('.listsum').eq(i).find('#J_CheckBox_170037950254').attr('checked') == 'checked') {

				strRes++;
				var data = $('.listsum').eq(i).find('input[name="items"]').attr('xue');
				data_arr[i] = data;
			}
		}

		if (strRes == 0) {

			layer.confirm('没有选中任何商品~', {
	            btn : [ '确定' ]//按钮
	        }, function(index) {
	            layer.close(index);
	        }); 
			return false;
		}

 		layer.confirm('确定要删除吗?', {
            btn : [ '确定', '取消' ]
        }, function(index) {
            layer.close(index);
            
			$.ajax({

				type: "POST",
			    url:  "<?php echo U('Cart/delAllCartData');?>",
			    data: {data : data_arr},
			    success: function (msg) {

			    	if (msg['code'] == 1200) {

			    		var number = Number($('.num_all').html());
			    		var cutNum = 0;

			    		for (var i=$('.listsum').length-1; i>=0; i--) {

							if ($('.listsum').eq(i).find('#J_CheckBox_170037950254').attr('checked') == 'checked') {

								cutNum++;
								$('.listsum').eq(i).remove();
							}
						}

						$('#J_SelectedItemsCount').html(0);
						$('#J_Total').html('0.00');
						$('.num_all').html(number-cutNum);

						if (number-cutNum <= 0) {

							$('#cartEmptyPage').css('display', 'block');
			    			$('#cart_body').css('display', 'none');
						}
			    	} else if (msg['code'] == 1606) {

			    		// 警告程序员.....
			    	}
			    },
			    dataType: 'json'
			});
        })
	});

	// 单条删除操作
	function delete_btn(obj, uid, cid, sid) {

		$.ajax({

			type: "POST",
		    url:  "<?php echo U('Cart/deleteCartData');?>",
		    data: "uid="+uid+"&cid="+cid+"&sid="+sid,
		    success: function (msg) {

		    	if (msg['code'] == 1200) {

		    		var number = parseInt($('.num_all').html());
		    		number--;
		    		$('.num_all').html(number);
		    		$(obj).parents('ul').remove();

		    		if (number <= 0) {

		    			$('#cartEmptyPage').css('display', 'block');
		    			$('#cart_body').css('display', 'none');
		    		}

		    		var priceNum = 0;
		    		var count = 0;
		    		for (var i=0; i<=$('.listsum').length; i++) {

						if ($('.listsum').eq(i).find('#J_CheckBox_170037950254').attr('checked') == 'checked') {

							count++;
							priceNum += Number($('.listsum').eq(i).find('#summary').html());
						}
					}

					$('#J_SelectedItemsCount').html(count);
					$('#J_Total').html(priceNum.toFixed(2));

		    	} else if (msg['code'] == 1606) {

		    		// 警告程序员....
		    	}
		    },
		    dataType: 'json'
		});
	}

	// 减操作
	function cut(obj, uid, cid, sid) {

		var num = Number($(obj).next().val());
		var price = Number($(obj).parents('li').prev().find('#em-tag').html());
		var summary = Number($(obj).parents('li').next().find('#summary').html());

		if (num <= 1) {
			return false;
		}
		num--;

		$.ajax({

			type: "POST",
		    url:   "<?php echo U('Cart/handlerCartNumber');?>",
		    data: "number="+num+"&uid="+uid+"&cid="+cid+"&sid="+sid,
		    success: function (msg) {

		    	if (msg['code'] == 1200) {

		    		$('.cutadd_div').remove();   // 删除警告的div
		    		$(obj).next().val(num);
					$(obj).parents('li').next().find('#summary').html((summary-price).toFixed(2));

					if ($(obj).parents('li').prev().prev().prev().prev().find('input').attr('checked') == 'checked') {

						var totil = Number($('#J_Total').html());
						$('#J_Total').html((totil-price).toFixed(2));
					}

					if (msg['goodsNum'] < 10) {

						$(obj).next().next().after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">仅剩&nbsp;'+msg['goodsNum']+'&nbsp;件</div>');
					}

					if (msg['goodsNum'] == 0) {

						$(obj).next().val(0);
						$(obj).next().next().after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">已售空~</div>');
					}
		    	} else if (msg['code'] == 1606) {

		    		$('.cutadd_div').remove();
		    		$(obj).next().next().after('<div class="cutadd_div" style="width:100%;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">库存不足, 仅剩&nbsp;'+msg['goodsNum']+'&nbsp;件</div>');
		    	}
		    },
		    dataType: 'json'
		});
	}

	// 失去焦点是触发
	$('input[name="num"]').blur(function () {

		var num = Number($(this).val());
		var idStr = $(this).attr('xiao');
		var that = $(this);

		if(num <= 0 || isNaN(num)) {
			num = 1;
			$(this).val(1);
		}

		$.ajax({

			type: "POST",
		    url:   "<?php echo U('Cart/handlerCartNumber');?>",
		    data: "number="+num+idStr,
		    success: function (msg) {

		    	if (msg['code'] == 1200) {

		    		$('.cutadd_div').remove();
		    		that.val(num);
		    		var price = Number(that.parents('li').prev().find('#em-tag').html());
					that.parents('li').next().find('#summary').html((price*num).toFixed(2));

					var summarize = 0;
					for (var i = 0; i<$('.listsum').length; i++) {

						if ($('.listsum').eq(i).find('#J_CheckBox_170037950254').attr('checked') == 'checked') {
							summarize += Number($('.listsum').eq(i).find('#summary').html());
						}
					}
					$('#J_Total').html(summarize.toFixed(2));

					if (msg['goodsNum'] < 10) {

						$(that).next().after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">仅剩&nbsp;'+msg['goodsNum']+'&nbsp;件</div>');
					}

					if (msg['goodsNum'] == 0) {

						$(obj).val(0);
						$(obj).next().after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">已售空~</div>');
					}
		    	} else if (msg['code'] == 1606) {

		    		$('.cutadd_div').remove();
		    		$(that).next().after('<div class="cutadd_div" style="width:100%;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">库存不足, 仅剩&nbsp;'+msg['goodsNum']+'&nbsp;件</div>');
		    	}
		    },
		    dataType: 'json'
		});
	})

	// 加操作
	function add(obj, uid, cid, sid) {
		var num = Number($(obj).prev().val());
		var price = Number($(obj).parents('li').prev().find('#em-tag').html());
		var summary = Number($(obj).parents('li').next().find('#summary').html());
		var number = Number($(obj).attr('numberData'));
		
		if (number) {

			if (num >= number) {

				$('.cutadd_div').remove();
				$(obj).after('<div class="cutadd_div" style="width:100%;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">库存不足, 仅剩&nbsp;'+number+'&nbsp;件</div>');
				return false;
			}
		}
		num++;

		$.ajax({

			type: "POST",
		    url:   "<?php echo U('Cart/handlerCartNumber');?>",
		    data: "number="+num+"&uid="+uid+"&cid="+cid+"&sid="+sid,
		    success: function (msg) {

		    	if (msg['code'] == 1200) {

		    		$('.cutadd_div').remove();     // 删除之前的警告div
					$(obj).prev().val(num);
					$(obj).parents('li').next().find('#summary').html((summary+price).toFixed(2));
					$(obj).attr('numberData', msg.goodsNum);

					if ($(obj).parents('li').prev().prev().prev().prev().find('input').attr('checked') == 'checked') {

						var totil = Number($('#J_Total').html());

						$('#J_Total').html((totil+price).toFixed(2));
					}

					if (msg['goodsNum'] < 10) {
						$(obj).after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">仅剩&nbsp;'+msg['goodsNum']+'&nbsp;件</div>');
					}

					if (msg['goodsNum'] == 0) {

						$(obj).prev().val(0);
						$(obj).after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">已售空~</div>');
					}
		    	} else if (msg['code'] == 1606) {

		    		$(obj).attr('numberData', msg.goodsNum);
		    		$('.cutadd_div').remove();
		    		$(obj).after('<div class="cutadd_div" style="width:100%;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">库存不足, 仅剩&nbsp;'+msg['goodsNum']+'&nbsp;件</div>');
		    	}
		    },
		    dataType: 'json'
		});
	}

	// 默认第一个商品
	$('input').first().attr('checked', true);
	$('#J_Total').html($('#summary').first().html());

	// 全选操作
	$('#J_SelectAllCbx2').click(function () {

		if ($(this).attr('checked') == 'checked') {

			$('input[name="items"]').attr('checked', true);
			var num_all = Number($('.num_all').html());
			$('#J_SelectedItemsCount').html(num_all);

			var summarize = 0;
			for (var i = 0; i<$('.listsum').length; i++) {

				summarize += Number($('.listsum').eq(i).find('#summary').html());
			}

			$('#J_Total').html(summarize.toFixed(2));

		} else {

			$('input[name="items"]').attr('checked', false);
			$('#J_SelectedItemsCount').html(0);
			$('#J_Total').html('0.00');
		}

	    var $subBox = $("input[name='items']");
	    $subBox.click(function(){

	        $("#J_SelectAllCbx2").attr("checked",$subBox.length == $("input[name='items']:checked").length ? true : false);
	    });
	})

	// 选择商品时触发
	function check_btn(obj) {

		var num = Number($('#J_SelectedItemsCount').html())
		if ($(obj).attr('checked') == 'checked') {

			num++;
			$('#J_SelectedItemsCount').html(num);

			var price = Number($(obj).parents('li').next().next().next().next().next().find('#summary').html());
			var totil = Number($('#J_Total').html());
			$('#J_Total').html((totil+price).toFixed(2));
		} else {

			num--;
			$('#J_SelectedItemsCount').html(num);

			var price = Number($(obj).parents('li').next().next().next().next().next().find('#summary').html());
			var totil = Number($('#J_Total').html());
			$('#J_Total').html((totil-price).toFixed(2));
		}
	}
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
</body>
</html>