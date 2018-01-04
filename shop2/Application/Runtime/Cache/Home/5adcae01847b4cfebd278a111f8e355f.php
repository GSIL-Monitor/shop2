<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript">
                window.__trace__headstart = +new Date;
                window.__server__startTime = 1513738428976;
                window.__token = "diEdw1ImGWYBG3YF9S7BIBxDJLR3z63YDpQOQFKfP6BJU6lQFnTo9Zmyzqjoj5pI";
    </script>
    

        <link rel="dns-prefetch" href="http://s.meilishuo.net/">
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

    
    
    
    <link rel="search" type="application/opensearchdescription+xml" href="http://cart.meilishuo.com/opensearch.xml">
    <link rel="icon" href="https://s10.mogucdn.com/mlcdn/c45406/170612_02i668aijej2cb21ji56g98a218dg_48x48.png" type="image/x-icon">

    <script type="text/javascript">
    var curl = {apiName: 'require'}; var MOGU = {}; var MoGu = {};
    var MOGU_DEV= 0 || "online" == "pre";
    var M_ENV = "online";
    </script>



                <link href="/shop2/Public/Home/css/index.css-460c13b0.css" rel="stylesheet" type="text/css">
    

        
        <link href="/shop2/Public/Home/css/index.css-342e66e0.css" rel="stylesheet" type="text/css">
    
    <!--[if lte IE 8]>
    <script src="https://s10.mogucdn.com/__mfp/meili-lib/assets/0.0.3/es5-shim.js,mfp/meili-lib/assets/0.0.3/es5-sham.js,mfp/meili-lib/assets/0.0.3/console-polyfill.js,mfp/meili-lib/assets/0.0.3/json2.js"></script>
    <![endif]-->

             
    
    

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
                            <img src="./空空的购物车_files/right.png" width="23" height="23" alt="">
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

<script type="text/template" id="tpl_cart_tab">


  <div class="g-wrap wrap">
      {{?it && it.tabItemNum}}
      <ul class="clearfix cart_slide pb20" id="cartSlide">
          <li>
              <a href="javascript:;" url="0" class="mr10 cart_slide_item cartSlideItemAll cart_slide_item_cur  {{?it.tabItemNum.allItemNum<=0}}cart_slide_not_allowed{{?}}">
                  全部商品 (<span class="num">{{=it.tabItemNum.allItemNum}}</span>)
              </a>
          </li>
         
      </ul>
      {{?}}

      <!-- 不为空的情况 -->

      <div class="cart_wrap cart_nobdbtm">


          <div class="cart_page_wrap" id="cartPage">

          </div>

          <div class="cart_page_wrap" id="cartEmptyPage" style="display:none;">
          <div class="cart_empty">
              <div class="cart_empty_icon"></div>

              <h5 class="mb20">您的购物车还是空的，赶快去挑选商品吧！</h5>
              <ul class="cart_empty_list">
                  <li>去看看大家都喜欢的<a href="http://www.meilishuo.com/guang/hot" class="cart_red cart_uline">最热</a></li>
                  <li>去看看正在折扣中的优品<a href="http://www.meilishuo.com" class="cart_red cart_uline">首页</a></li>
              </ul>
          </div>
          </div>

      </div>


      {{?it && it.totalItemNum > 0}}

      <div class="cart_paybar wrap" id="cartPaybar">
          <a href="javascript:;" class="cart_paybtn fr cart_paybtn_disable" id="payBtn">去付款</a>

          <div class="cart_paybar_info_cost cart_deep_red cart_bold cart_font26 cart_money fr goodsSum">¥ </div>
          <div class="cart_paybar_info cart_pregray fr">
              共有 <span class="cart_deep_red goodsNum">0</span> 款商品，总计：
          </div>


         <!-- <div class="act-bottom-event fr">
              <img class="event-img" src="" />
              <span></span>
                      <span id="J_ActCountdown" data-remaining="">
                          <span class="an"></span>天<span
                                  class="an"></span>小时<span
                                  class="an"></span>分<span
                                  class="an"></span>秒
                      </span>
          </div> -->


          <div class="cart_paybar_vmbox">
              <input type="checkbox" name="s_all" class="s_all_slave cart_vm" id="s_all_f" />

              <label for="s_all_f" class="mr10">全选</label>

              <a href="javascript:;" class="mr10 cart_uline cart_pregray" id="cartRemoveChecked">删除</a>
              <a href="javascript:;" class="mr10 cart_uline cart_pregray" id="cartRemoveUnuse">清空失效商品</a>
          </div>

      </div>

      <form action="http://buy.meilishuo.com/mls/buy" id="postform" method="POST" >
          <input type="hidden" name="postdata" id="postdata" />
          <input type="hidden" name="mtk" value="" />
          <input type="hidden" name="ptp" id="ptpdata" />
      </form>

      {{?}}
  </div>
</script>

    <div class="g-wrap wrap">  <!-- 不为空的情况 --> 
        <div class="cart_wrap"> 
            <div class="cart_page_wrap" id="cartPage" style="display: none;"></div> 
            <div class="cart_page_wrap" id="cartEmptyPage"> 
                <div class="cart_empty"> 
                    <div class="cart_empty_icon"></div> 
                    <h5 class="mb20">您的购物车还是空的，赶快去挑选商品吧！</h5> 
                    <ul class="cart_empty_list"> 
                        <li>去看看大家都喜欢的<a href="http://www.meilishuo.com/guang/hot" class="cart_red cart_uline">最热</a></li> 
                        <li>去看看正在折扣中的优品<a href="http://www.meilishuo.com/" class="cart_red cart_uline">首页</a></li> 
                    </ul> 
                </div> 
            </div> 
        </div>  
    </div>  


</div>





</body>
</html>