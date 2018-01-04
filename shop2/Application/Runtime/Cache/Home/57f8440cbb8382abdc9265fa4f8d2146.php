<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript">
                window.__trace__headstart = +new Date;
                window.__server__startTime = 1513738539777;
                window.__token = "diEdw1ImGWYBG3YF9S7BIBxDJLR3z63YDpQOQFKfP6BqpXxAUd1xHCpryYYhpWDH";
    </script>
    


    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171729.25" />
   
  
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/datepicker.css?1607171729.25" />
    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1"></script>   
    <meta http-equiv="Cache-Control" content="no-transform ">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>我的购物车</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="copyright" content="meilishuo.com">

        <link href="/shop2/Public/myjs/css/cartstyle.css" rel="stylesheet" type="text/css" />
       
        
        <script type="text/javascript" src="/shop2/Public/myjs/js/jquery.js"></script>

    <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
    <link href="/shop2/Public/Home/css/index.css-dbb86485.css" rel="stylesheet" type="text/css"/>
    <link href="/shop2/Public/Home/__newtown/trade_cart_web/assets/mls-pc/pages/cartList/index.css-005591bf.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/shop2/Public/Home/js/pkg-pc-base.js-beb518b8.js"></script>
    
    
    
    <link rel="search" type="application/opensearchdescription+xml" href="http://cart.meilishuo.com/opensearch.xml">
    <link rel="icon" href="https://s10.mogucdn.com/mlcdn/c45406/170612_02i668aijej2cb21ji56g98a218dg_48x48.png" type="image/x-icon">

    <script type="text/javascript">
    var curl = {apiName: 'require'}; var MOGU = {}; var MoGu = {};
    var MOGU_DEV= 0 || "online" == "pre";
    var M_ENV = "online";
    </script>



                <link href="/shop2/Public/Home/css/index.css-460c13b0.css" rel="stylesheet" type="text/css">
    

        
        <link href="/shop2/Public/Home/css/index.css-342e66e0.css" rel="stylesheet" type="text/css">
    

    <script type="text/javascript">

        if(window.require) {
            require.config({
                domain: 0
            });
        }

        MOGUPROFILE = {};
    </script>

</head>

<body class="media_screen_1200">
<!-- <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js"></script> -->
<script type="text/javascript" src="/shop2/Public/Home/js/jquery.min.js"></script>

    
<script type="text/javascript">
    /**
    ** for layout 960
    **/
    (function(){
        var wWidth = $(window).width(); if(wWidth < 1212){ $('body').addClass('media_screen_960'); } else { $('body').addClass('media_screen_1200'); }
        //initTime for log 判断对象是否存在
        window.MoGu && $.isFunction(MoGu.set) && MoGu.set('initTime', (new Date()).getTime());

        var ua = navigator.userAgent;
        // 判断是否是ipad
        var is_plat_ipad = ua.match(/(iPad).*OS\s([\d_]+)/);
        if(is_plat_ipad) {
            $('body').addClass('media_ipad');
        }
        // 判断是否是ipadApp
        var is_plat_ipadApp = ua.indexOf('MeilishuoHD') >= 0 || location.href.indexOf('_atype=ipad') >= 0;
        if(is_plat_ipadApp) {
            $('body').addClass('media_ipad_app');
            // 隐藏头尾
            $('body').append('<style type="text/css">.header_2015,.header_nav,.foot .foot_wrap{display: none;}.foot{height: 0;background: none;}.back2top_wrap{height:0;width:0;overflow:hidden;opacity:0;}</style>');
            // 移除购物车，返回顶部
            setTimeout(function(){
                $('.back2top_wrap').remove();
            },1000)
        }
    })();
</script>

    <div class="mgj_rightbar" data-ptp="_sidebar"></div>
<div id="header" data-ptp="_head">
    <!-- 头标签 -->

<?php
 if ($logout) { $url = '/shop2/Home/Login'; }else{ $url = '/shop2/Home/Person'; } ?>
<div id="com-topbar">
  <div class="inner">
    <ul>
      <li class="drop" style="float:left">
              <a href="" >
                <em class="home"></em>美丽说首页</a>
           
      </li>
      <li class="drop">
        <a href="<?=$url?>" class="nick" target="_blank">
          <img class="face" src="/shop2/Public/Home/new1/v1/bdefaultavatar//03.jpg" />
          <?php if(($logout == 1)): ?>请登录
            <?php else: ?>
            <?php echo ($user['account']); endif; ?>
          <em class="arrow"></em></a>
        <ul class="down account">
          <li>
            <a href="<?=$url?>" target="_blank">账号与安全</a></li>
          <li>
            <a href="javascript:;" onclick="setLogout()" <?=$logout?'style="display:none"':''?>>退出</a></li>
        </ul>
      </li>
      <li class="drop">
              <a href="<?php echo U('Register/index');?>" >
                注册</a>
           
      </li>
      <li class="drop">
        <a href="mylike.html" target="_blank">
          <em class="collect"></em>我的收藏</a>
        <ul class="down">
          <li>
            <a href="mylike.html" target="_blank">收藏宝贝</a></li>
          <li>
            <a href="mylikestore.html" target="_blank">收藏店铺</a></li>
        </ul>
      </li>
      <li class="drop cart-wrapper">
        <a target="_blank" href="<?php echo U('Cart/showMyCartView');?>" class="my-cart">
          <em class="cart"></em>我的购物车</a>
        <div class="hidden">
          <ul class="cart-goods"></ul>
          <p class="cart-account">
            <span>购物车里还有
              <a class="num" href="<?php echo U('Cart/showMyCartView');?>" target="_blank"></a>件商品</span>
            <a class="check-cart" href="<?php echo U('Cart/showMyCartView');?>" target="_blank">查看购物车</a></p>
        </div>
      </li>
      <li>
        <a href="orderlist.html" target="_blank">
          <em class="order"></em>我的订单</a>
      </li>
    </ul>
  </div>
</div>
<script type="text/javascript">
  
    function setLogout(){
      console.log('行不行');
      $.ajax({
          type:'post',
          url:"<?php echo U('Login/logout');?>",
          data:'logout=1',
          success:function(msg){
            console.log(msg);
              if (msg['code'] == 1200) {
                  location.reload([true]);
                  // console.log('注销没');
              }
          },
          error:function(msg){
              layer.confirm('访问服务器失败.');
          },
          dataType:'json'
      });
    }
    

</script>
</div>
    <!-- 中间区域 -->
<!--<div class="header_mid clearfix">
    <div class="wrap">
        <a rel="nofollow" href="http://www.mogujie.com" class="logo" title="蘑菇街首页"></a>
                        <div class="mid_fr">
            <div class="nav_mogu_qrcode">
                <img width="70" height="70" src="http://s18.mogucdn.com/p1/150929/upload_iezggyjwgrrdgztfgmzdambqmmyde_300x300.png" alt="蘑菇街客户端下载"/>
                <p>蘑菇街客户端</p>
            </div>
        </div>
    </div>
</div>
-->

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
                            <img  width="23" height="23" alt="">
                            <span class="md_process_tip">完成</span>
                        </i>
                    </div>
                </div>        
            </div>
            <div style="padding-top:10px">
              <img src="/shop2/Public/Home/img/logos.png">
            </div>
        </div>
    </div>


        <!-- 不为空的情况 --> 
   <div class="g-wrap wrap">
        <?php if (empty($cartData)) { ?>
  
    
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
        <ul class="clearfix cart_slide pb20" id="cartSlide"> 
            <li> 
                <a href="javascript:;" url="0" class="mr10 cart_slide_item cartSlideItemAll cart_slide_item_cur  "> 全部商品 (<span class="num num_all"><?=count($cartData)?></span>) </a> 
            </li> 
            <li class="cartslide-line">|</li> 
          
        </ul> 
        <div class="cart_wrap cart_nobdbtm"> 
            <div class="cart_page_wrap" id="cartPage"> 
         
                <!-- 表格 --> 
                <table class="cart_table" id="cartOrderTable"> 
                    <thead> 
                    <tr> 
                        <th class="cart_table_check_wrap cart_alleft pl10"> 
                          <!--   <input type="checkbox" name="s_all" class="s_all tr_checkmr" id="s_all_h"> 
                            <label for="s_all_h">全选</label>  -->
                        </th>
                       <th class="cart_table_goods_wrap">商品</th> 
                        <th class="cart_table_goodsinfo_wrap">商品信息</th> 
                        <th>单价(元)</th> 
                        <th class="cart_table_goodsnum_wrap">数量</th>
                        <th class="cart_table_goodssum_wrap">小计(元)</th> <th class="cart_table_goodsctrl_wrap">操作</th> 
                    </tr> 
                    </thead> 
                    <tbody>
                    <?php if(is_array($cartData)): foreach($cartData as $key=>$vo): ?><tr class="cart_mitem " data-cut="true" data-isless="false" data-bid="1okp1s" data-sellerid="13ldhhi" data-stockid="1uvtkg0" data-tradeitemid="1kll1lm" data-ptps="1.8HXjYt934Q" data-ptp="_shoppingcart" data-price="17000"> 
                            <td class="vm ">   
                                <input type="checkbox" class="cart_thcheck" class="check" data-stockid="1uvtkg0" id="J_CheckBox_170037950254" xue="<?php echo ($vo["id"]); ?>:<?php echo ($vo['cid']); ?>:<?php echo ($vo['sid']); ?>" onclick="check_btn(this)">  
                            </td> 
                            <td class="cart_table_goods_wrap">
                            <!-- 商品 --> 
                                <a href="" target="_blank" class="cart_goods_img"> 
                                    <img class="cartImgTip" src="/shop2/Public/Uploads/<?php echo ($vo['pic']); ?>" width="78" height="78" alt="<?php echo ($vo['name']); ?>">  
                                </a> 
                            <!-- 商品title --> 
                                <a href="ht1Yt934Q" target="_blank" class="cart_goods_t cart_hoverline" title="<?php echo ($vo['name']); ?>"> <?php echo ($vo["name"]); ?> </a> 
                                <p class="remind_btm"> <!-- 降价信息 -->  </p> 
                            </td> 
                            <td>  
                                <p class="cart_lh20">颜色：<?php echo ($vo["color"]); ?></p>  
                                <p class="cart_lh20">尺码：<?php echo ($vo["size"]); ?></p>  
                            </td> 
                            <td class="cart_alcenter">
                                <!-- 单价 -->  
                                <p class="cart_lh20 cart_throughline cart_lightgray">170.00</p> 
                                <p class="cart_lh20 cart_bold cart_data_sprice" data-price="119.00" id="em-tag"> <?php echo ($vo["price"]); ?></p>   
                                <p> <span class="cart_tip_yellow cart_tip_focuswidth">店铺推荐</span> </p>  
                            </td> 
                            <td class="cart_alcenter">
                                <!-- 数量 -->  
                                <div> 
                                    <div class="cart_num cart_counter" data-stockid="1uvtkg0" data-stocknum="180" data-timestamp="" > 
                                        <span class="cart_num_reduce <?php if($vo['number'] == 1) echo "disable";?>" onclick="cut(this, <?php echo ($vo["uid"]); ?>, <?php echo ($vo['cid']); ?>, <?php echo ($vo['sid']); ?>)"></span>   
                                        <input type="text" class="cart_num_input cart_bold" maxlength="3" value="<?php echo ($vo['number']); ?>">  
                                        <span class="cart_num_add" onclick="add(this, <?php echo ($vo["uid"]); ?>, <?php echo ($vo['cid']); ?>, <?php echo ($vo['sid']); ?>)"  numberData=""></span> 
                                    </div> 
                                </div>   
                            </td> 
                            <td class="cart_alcenter">
                                <!-- 小计 --> <p class="cart_deep_red cart_font16 item_sum" data-unit="119" data-price="119.00" id="summary"><?=number_format($vo['price']*$vo['number'], 2, '.', '')?></p> 
                            </td>
                            <td class="cart_alcenter">
                                <!-- 操作 --> 
                                <a href="javascript:;" onclick="delete_btn(this, <?php echo ($vo['uid']); ?>, <?php echo ($vo['cid']); ?>, <?php echo ($vo['sid']); ?>)" class="delete">删除</a><br> 
                                    <a title="移入收藏夹" id="keep_click" ke="<?php echo ($vo["uid"]); ?>:<?php echo ($vo['cid']); ?>:<?php echo ($vo['sid']); ?>" class="btn-fav" href="#">移入收藏夹</a>
                            </td> 
                        </tr>   
                      <!--   <tr class="J_mundo m-undo">  
                            <td colspan="7"> 
                                <div class="m-undo-wrap">成功删除 
                                <span class="J_num">1</span> 款商品，如有误，可
                                <a href="javascript:;" class="J_undo">撤销本次删除</a></div> 
                            </td> 
                        </tr> --><?php endforeach; endif; ?>     
                    </tbody> 
                </table> 
                <!-- 表格 end -->
            </div> 


        </div>  
        <div class="cart_paybar wrap" id="cartPaybar"> 
            <a href="javascript:;" class="cart_paybtn fr cart_paybtn_disable" id="payBtn">去付款</a> 
            <div class="cart_paybar_info_cost cart_deep_red cart_bold cart_font26 cart_money fr goodsSum "  id="J_Total">¥ 0.00</div> 
            <div class="cart_paybar_info cart_pregray fr"> 共有 <span id="J_SelectedItemsCount"><?=empty($cartData)?0:1;?></span> 款商品，总计： </div> <!-- <div class="act-bottom-event fr"> <img class="event-img" src="" /> <span></span> <span id="J_ActCountdown" data-remaining=""> <span class="an"></span>天<span class="an"></span>小时<span class="an"></span>分<span class="an"></span>秒 </span> </div> --> 
            <div class="cart_paybar_vmbox"> 
                <input type="checkbox" name="s_all" class="s_all_slave cart_vm" id="s_all_f"> 
                <label for="s_all_f" class="mr10">全选</label> 
                <a href="javascript:;" class="mr10 cart_uline cart_pregray" id="cartRemoveChecked">删除</a> 
                <a href="javascript:;" class="mr10 cart_uline cart_pregray" id="cartRemoveUnuse">清空失效商品</a> 
            </div> 
        </div> 
        </div> 
       
        <?php }?>
    </div>



</div>


      <div class="g-footer">
    <p title="mofa015027">
        <a href="http://www.meilishuo.com/" target="_blank">美丽说</a>
        © 2016 Meilishuo.com,All Rights Reserved.
    </p>
    <div class="icons">
        <a class="vs" href="javascript:;"></a>
        <a class="mc" href="javascript:;"></a>
        <a class="up" href="javascript:;"></a>
        <a class="pa" href="http://bank.pingan.com/index.shtml" target="_blank"></a>
        <a class="kx" href="https://ss.knet.cn/verifyseal.dll?sn=e14090533010053532r3hn000000&amp;ct=df&amp;a=1&amp;pa=500267&amp;tp=1.0.20.0.28.KXYH9AB" target="_blank"></a>
        <a class="pc" href="http://www.pingpinganan.gov.cn/" target="_blank"></a>
    </div>
</div>


 



<div class="widget_mtip_box mtip_right" style="width: auto; left: 263.5px; top: 301px; z-index: auto; display: none;">
    <div class="widget_mtip_line">
        <div class="cart_imgtip_wrap">
            <img src="/shop2/Public/Home/img/170925_6hlfc04ik8jha04g3dje1ejkb7gia_800x800.jpg_280x999.jpg" width="240"></div>
        </div>
    <i class="widget_mtip_ang widget_mtip_a" style="display: block; left: 0px; right: auto; top: 42px; bottom: auto;"></i>
    <i class="widget_mtip_shadow widget_mtip_a" style="display: block; left: 0px; right: auto; top: 42px; bottom: auto;"></i>
    <a href="javascript:;" class="widget_mtip_close" style="display: none;">×</a>
</div>

<script type="text/javascript">
    

    $('#payBtn').click(function () {
        
        var num = 0;
        var data_arr = new Array($('.cart_mitem').length);
        for (var i=0; i<$('.cart_mitem').length; i++) {

            if ($('.cart_mitem').eq(i).find('#J_CheckBox_170037950254').attr('checked') == 'checked') {

                var data = $('.cart_mitem').eq(i).find('#keep_click').attr('ke');
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

                    for (var i=0; i<$('.cart_mitem').length; i++) {

                        if ($('.cart_mitem').eq(i).find('#keep_click').attr('ke') == msg['id']) {

                            $('.cutadd_div').remove();
                            $('.cart_mitem').eq(i).find('#addNumber').after('<div class="cutadd_div" style="width:100px;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">该商品已售空~</div>');
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

        // 加操作
    function add(obj, uid, cid, sid) {
        var num = Number($(obj).prev().val());
        var price = Number($(obj).parents('td').prev().find('#em-tag').html());
        var summary = Number($(obj).parents('td').next().find('#summary').html());
        var number = Number($(obj).attr('numberData'));
        
        if (number) {

            if (num >= number) {

                $('.cutadd_div').remove();
                $(obj).after('<div class="cutadd_div" style="width:100%;height:25px;margin:0px auto;margin-top:5px;line-height:25px;color:#f30;font-weight:bold;">库存不足, 仅剩&nbsp;'+number+'&nbsp;件</div>');
                return false;
            }
        }
        $(obj).parent().find('.cart_num_reduce').removeClass('disable');
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

        // 减操作
    function cut(obj, uid, cid, sid) {

        var num = Number($(obj).next().val());
        var price = Number($(obj).parents('td').prev().find('#em-tag').html());
        var summary = Number($(obj).parents('td').next().find('#summary').html());

        if (num <= 1) {
            $(obj).addClass('disable');
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
                    $(obj).parents('tr').remove();

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

// 默认第一个商品
    $('input').first().attr('checked', true);
    $('#J_Total').html($('#summary').first().html());

    // 选择商品时触发
    function check_btn(obj) {

        var num = Number($('#J_SelectedItemsCount').html());
        console.log(num);
        if ($(obj).attr('checked') == true) {
            console.log(888);

            num++;
            $('#J_SelectedItemsCount').html(num);

            var price = Number($(obj).parents('tr').find('#summary').html());
            var totil = Number($('#J_Total').html());
            console.log(price);
            console.log(totil);
            $('#J_Total').html((totil+price).toFixed(2));
        } else {

            num--;
            $('#J_SelectedItemsCount').html(num);

            var price = Number($(obj).parents('tr').find('#summary').html());
            var totil = Number($('#J_Total').html());
            $('#J_Total').html((totil-price).toFixed(2));
        }
    }


</script>


</body>
</html>