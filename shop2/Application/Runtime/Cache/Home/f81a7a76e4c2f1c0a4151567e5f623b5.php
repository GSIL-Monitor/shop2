<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        订单列表_美丽说
    </title>

    <meta name="description" content="<?php echo ($datas['desc']); ?>" />
    <meta name="keywords" content="<?php echo ($datas['keywords']); ?>" />


    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171729.25" />
   
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/common.css?1607171729.25" />
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/datepicker.css?1607171729.25" />
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/setPersonal.css?1607171729.25" />
    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1"></script>    
  
     
<script type="text/javascript" src="/shop2/Public/Home/js/index.js-417ef0a2.js"></script>

<script type="text/javascript" src="/shop2/Public/Home/js/index.js-800cd574.js"></script>


    
    <script type="text/javascript">
             window.__trace__headstart = +new Date;
                window.__server__startTime = 1513608913207; 
                window.__token = "diEdw1ImGWYBG3YF9S7BIMTJ5%2FdfCvYqq9xAR%2BRorgtEoX0P1uF9CzBK%2Bla0lb9N";
    </script>



    <meta http-equiv="Cache-Control" content="no-transform " />
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>





    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml"/>
    <link rel="icon" href="/shop2/Public/Home/p1/160614/idid_ifrtgzddgm3dmnjshezdambqhayde_49x48.png" type="image/x-icon"/>

    <script> curl = {apiName: 'require'}; var MOGU = {}; var MoGu = {};</script>



    <link href="/shop2/Public/Home/css/index.css-63e7a9a6.css" rel="stylesheet" type="text/css"/>



    <link href="/shop2/Public/Home/css/index.css-0c69c351.css" rel="stylesheet" type="text/css"/>
    

    <script>fml.setOptions({
      'sversion': '1607171729.25',
      'defer': true,
      'modulebase': '/shop2/Public/Home/pc/jsmin/'
    });
    var Meilishuo = {
      "config": {
        "nt": "1yQyN1tU7ssTVQ5GeZ16wwRPabJ4BkL3wzam74AVT5OJrQL/R3WLC7FHZrGIgzOQ",
        "main_site_domain": "/",
        "server_url": "/",  
        "picture_url": "http://i.meilishuo.net/css/",
        "captcha_url": "http://captcha.meilishuo.com/",
        "im_url": "http://imlab.meilishuo.com/",
        "forSale": false,
        "controller": "setPersonal",
        "isLogin": true,
        "userInfo": {
          "name": "阿猫来了",
          "uid": "11cnkktq",
          "avatar": "http://s2.mogucdn.com/new1/v1/bdefaultavatar/03.jpg"
        }
      }
    };
    </script>

</head>

<body>
    <div class="head">
         <!-- 头标签 -->

<?php
 if (@$logout) { $url = '/shop2/Home/Login'; }else{ $url = '/shop2/Home/Person'; } ?>
<div id="com-topbar">
  <div class="inner">
    <ul>
      <li class="drop" style="float:left">
              <a href="<?php echo U('Index/index');?>" >
                <em class="home"></em>美丽说首页</a>
           
      </li>
      <li class="drop">
        <a href="<?=$url?>" class="nick" target="_blank">
        
           <?php if(empty($picc)): ?><img class="face" src="/shop2/Public/Home/new1/v1/bdefaultavatar//03.jpg" />
            <?php else: ?>
            <img class="face" src="/shop2/Public/Uploads/<?php echo ($picc); ?>"><?php endif; ?>
          <?php if((@$logout == 1)): ?>请登录
            <?php else: ?>
         <?php echo ($account); endif; ?>
          <em class="arrow"></em></a>
        <ul class="down account">
          <li>
            <a href="<?=$url?>">账号与安全</a></li>
          <li>
            <a href="javascript:;" onclick="setLogout()" <?=@$logout?'style="display:none"':''?>>退出</a></li>
        </ul>
      </li>
      <li class="drop">
              <a href="<?php echo U('Register/index');?>" >
                注册</a>
           
      </li>
      <li class="drop">
        <a href="<?php echo U('Collect/index');?>" target="_blank">
          <em class="collect"></em>我的收藏</a>
        <!-- <ul class="down">
          <li>
            <a href="mylike.html" target="_blank">收藏宝贝</a></li>
          <li>
            <a href="mylikestore.html" target="_blank">收藏店铺</a></li>
        </ul> -->
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
        <a href="<?php echo U('Person/showOrderView');?>" target="_blank">
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
                  // location.reload([true]);
                 window.location.href="<?php echo U('Index/index');?>";
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

      
            
          
          
        <div id="com-search">
            <div class="inner">
                <a href="index.html" class="logo">
                    <img src="/shop2/Public/Uploads/<?php echo ($datas['icon']); ?>" alt="" width="204px" height="52px">
                </a>
                <a href="" class="sublogo"></a>
                <div class="search">
                   
            
              
                </div>
                <a class="spread">
                    <img src="/shop2/Public/Home/img/210x157.gif">
                </a>
               
            </div>
        </div>
        <div class="nav_main_box">
        
        </div>
    </div>
    <div class="settings">
    <div class="pcenter_navBar">
        <div class="pcenter_userhead">
            <div class="pcenter_userhead_content"> 
                <div class="header_info">
                    <div class="header_avatar">
                        <a href="<?php echo U('Person/setAvatar');?>">
                            <?php if(empty($picc)): ?><img style="width: 100%" src="http://s2.mogucdn.com/new1/v1/bdefaultavatar/03.jpg" alt="">
                            <?php else: ?>
                            <img style="width: 100%" src="/shop2/Public/Uploads/<?php echo ($picc); ?>" alt=""><?php endif; ?>
                            <p>修改头像</p>
                            <div class="header_info_mask"></div>
                        </a>
                    </div>
                </div>
                <?php if(empty($username)): ?><div class="username"></div> 
             
                <?php else: ?>
                <div class="username"><?php echo ($username); ?></div><?php endif; ?>
            </div>
        </div>
        <ul class="pcenter_navBar_ul"> 
            <li>
                <a class="menu_order disable-a">我的订单</a>
                <ul>
                    <?php $count = M('orders')->count();?>
                    <?php $priCount = M('orders')->where(['status'=> 1])->count();?>
                    <?php $numCount = M('orders')->where(['status'=> 3])->count();?>
                    <?php $conCount = M('orders')->where(['status'=> 4])->count();?>
                    <li><a class="" href="<?php echo U('Person/showOrderView');?>">全部订单(<?php echo ($count); ?>)</a></li>
                    <li><a class="" href="<?php echo U('Person/showOrderView', ['status' => 1]);?>">待付款(<?php echo ($priCount); ?>)</a></li>
                    <li><a class="" href="<?php echo U('Person/showOrderView', ['status' => 2]);?>" target="_blank">待收货(<?php echo ($numCount); ?>)</a></li>
                    <li><a class="" href="<?php echo U('Person/showOrderView', ['status' => 3]);?>" target="_blank">待评价(<?php echo ($conCount); ?>)</a></li>
                    <li><a class="" href="javascript:;" target="_blank">退款退货</a></li>
                    <li><a class="" href="javascript:;" target="_blank">订单回收站</a></li>
                </ul>
            </li>
            <li>
                <a class="disable-a ">优惠特权</a>
                <ul>
                    <li><a class="menu_coupon_plat" href="<?php echo U('Person/showScoreView');?>">积分管理</a></li>
                    <!-- <li><a class="menu_coupon_shop" href="coupon.html#?pages=1&coupon_type=2&status=0">店铺优惠券</a></li> -->
                    <li><a class="menu_vip"  target="_blank">会员特权</a></li>
                </ul>
            </li>
            <li>
              <a class="menu_order menu_footprint" href="footprint.html">我的足迹
                <em class="little-triangle"></em>
                <em class="little-triangle-hover"></em>
              </a>
            </li>
            <li>
              <a class="menu_order" href="<?php echo U('Person/address');?>">地址管理
                <em class="little-triangle"></em>
                <em class="little-triangle-hover"></em>
              </a>
            </li>
            <li>
              <a class="disable-a">账号管理</a>
              <ul>
                <li>
                  <a class="menu_setPersonal" href="<?php echo U('Person/setPersonal');?>">我的信息</a></li>
                <li>
                  <a class="menu_setAvatar" href="<?php echo U('Person/setAvatar');?>">个人头像</a></li>
              </ul>
            </li>
            <li>
              <a class="disable-a">安全中心</a>
              <ul>
                <li>
                  <a class="menu_setPassword" href="<?php echo U('Person/setPassword');?>">用户密码</a></li>
                <li>
                  <a class="menu_payPassword">支付密码</a></li>
                <li>
                  <a class="menu_bindmail" href="<?php echo U('Person/changeMail');?>">邮箱绑定</a></li>
                <li>
                  <a class="menu_loginEqm" >登录设备</a></li>
              </ul>
            </li>
        </ul>
    </div>
<!--     
    
</div> -->
    
  


    
        <div class="settings_box">
            <div class="order-title">
                <ul class="order-title-column clearfix">
                    <li class="goods">商品</li>
                    <li class="price">单价(元)</li>
                    <li class="quantity">数量</li>
                    <li class="aftersale">售后</li>
                    <li class="total">实付款(元)</li>
                    <li class="status">交易状态</li>
                    <li class="other">操作</li>
                </ul>
        </div>
   <div id="orderWrap"><!-- 有订单 --><!-- 回收站 -->
        <div class="order-list">  <!--订单class 未支付 order-section unpaid //未确认 order-section unconfirmed 完成 order-section finished --> 
            <div class="order-section " data-payid="73708977941518"> 
                <table class="order-table"> 
                 <tbody>  <!-- shop头部 --> 
                     <tr class="order-table-header"> 
                        <td colspan="7"> 
                            <div class="order-info fl">  <!-- 编号：已付款->shopOrderId 未付款->payOrderId --> 
                                <span class="no"> 订单编号： <span class="order_num"> 73708977951518 </span> 
                                </span> 
                                <span class="deal-time"> 成交时间：2017-12-18 22:54:09 </span>  
                                <a class="shop-name" target="_blank" href="http://s.meilishuo.com/14lqe"> 店铺：
                                    <span>这个女孩不懂事</span> 
                                </a>  
                            </div>  
                            <a href="javascript:;" class="mlstalk_widget_btn" data-shopid="14lqe"> 联系商家 </a>  
                        </td> 
                    </tr> <!-- shop头部end --> <!-- shop内容 -->  
                    <tr class="order-table-item last"> 
                        <td class="goods"> 
                            <a class="pic" href="http://item.meilishuo.com/detail/1jydn8u" title="查看宝贝详情" hidefocus="true" target="_blank"> 
                                <img src="/shop2/Public/Home/img/68188906_ie4tandcg5qtmnrxhezdambqgqyde_640x960.jpg" alt="查看宝贝详情" width="70"> 
                            </a> 
                            <div class="desc"> 
                                <p> <a href="http://item.meilishuo.com/detail/1jydn8u" target="_blank">【五对装】韩版休闲秋冬男士浅口船袜子袜男四季防臭隐形短袜</a> <!--订单快照-->  <!-- <a class="snapshot" href="http://www.meilishuo.com/mls/trade/order/snap?orderId=11g96vgqk5w" target="_blank">[交易快照]</a> -->  
                                </p>    
                                <p>尺码：P2044 男士短袜（组合一 五对装）</p>     
                                <ul class="ui-tags-list clearfix">  
                                    <li class="ui-tags-item"> 
                                    <img class="ui-tag-pic" src="/shop2/Public/Home/img/idid_ifrtqmrqmzswenrrgyzdambqhayde_18x18.png" alt=""> 
                                        <div class="ui-tag-text ui-hide"> 
                                            <a class="ui-tag-link" href="javascript:void(0)">72小时发货</a> 
                                            <span class="ui-icon-arrow"></span> 
                                        </div> 
                                    </li>  
                                </ul>  
                            </div> 
                         </td> 
                        <td class="price">  
                            <p class="price-old">17.00</p>  
                            <p>11.90</p> 
                        </td> 
                        <td class="quantity">1</td> 
                         <td class="aftersale">   <!-- 申请退货退款等操作 -->  
                            <a class="order-link" target="_blank" data-orderid="" href="http://www.meilishuo.com/refund/request?orderId=73708977961518">退款</a> <!-- <a class="order-link" target="_blank" data-orderid="" href="http://refund.meilishuo.com/mls/trade/refund/request?orderId=73708977961518">退款</a> --> <!-- 申请详情 class="order-link refund"-->    
                        </td> <!-- 多个商品的时候 后三列中每列只显示同个内容 --> 
                        <td class="total" rowspan="1">   
                            <p class="total-price" data="22">￥11.90</p>   
                            <p>(全国包邮)</p>    
                        </td> 
                        <td class="status" rowspan="1">  
                             <p class=""> 待发货 </p>   
                            <a href="http://buyer.meilishuo.com/mls/order/detail4buyer?orderId=73708977951518" class="order-link go-detail-link" target="_blank">订单详情</a>  <!-- 查看物流 --> <!--  --> 
                         </td> 
                        <td class="other" rowspan="1"> <!-- 回收站 -->  <!-- 已付款后显示 -->  
                            <ul>   <!-- 删除！订单 -->  
                                <li><a class="order-link order-remind" href="javascript:;" data-shopid="73708977951518">提醒商家发货</a></li> 
                                <li><span class="order-remind-tip">+1 已提醒商家</span></li> <!-- 确认收货 -->    
                            </ul>  
                        </td> 
                    </tr>  <!-- shop内容end --> <!-- 预售 -->  <!-- 预售end -->  <!-- 未付款时显示 -->  <!-- 未付款时显示end --> 
                </tbody> 
            </table> 
        </div>
     </div>
     <!-- 翻页 -->
     <div id="paginator-list"></div>
</div>
        </div>


</div>




    <div id="com-foot">
        <div class="inner">
            <div class="flist">
                <h4>买家帮助</h4>
                <div><a href="noviceGuide.html" target="_blank">新手指南</a></div>
                <div><a href="serviceEnsure.html" target="_blank">服务保障</a></div>
                <div><a href="helpCommon.html" target="_blank">常见问题</a></div>
                <div><a href="shoppingHelp.html" target="_blank">购物帮助</a></div>
            </div>
            <div class="flist">
                <h4>商家帮助</h4>
                <div><a href="#/business" target="_blank">商家入驻</a></div>
                <div><a href="#" target="_blank">商家后台</a></div>
                <div><a href="#" target="_blank">商家推广</a></div>
            </div>
            <div class="flist">
                <h4>关于我们</h4>
                <div><a href="aboutus.html" target="_blank">关于美丽说</a></div>
                <div><a href="contactus.html" target="_blank">联系我们</a></div>
            </div>
            <div class="flist aboutus">
                <h4>关注我们</h4>
                <div>
                    <a href="#" target="_blank">
                        <span class="i-sina"></span>新浪微博
                        <div class="follow">一键关注新浪微博
                          <wb:follow-button uid="1718455577" type="red_1" width="67" height="24"></wb:follow-button></div>
                    </a>
                </div>
                <div>
                    <a href="#" target="_blank">
                    <span class="i-qzone"></span>QQ空间</a>
                </div>
                <div>
                    <a href="#" target="_blank">
                    <span class="i-tencent"></span>腾讯微博</a>
                </div>
            </div>
            <div class="flist service">
                <h4>美丽说微信服务号</h4>
                <img class="qrcode" src="http://s7.mogucdn.com/p2/160802/7e_61hjl8kjfjfagkg3cdaj05fghck9c_100x100.png" alt="美丽说服务号二维码" />
            </div>
            <div class="flist last" style="float:left;">
                <h4>美丽说客户端下载</h4>
                <p style="background:none; margin-top:0px;" class="client">
                    <img class="qrcode" src="/shop2/Public/Home/p2/160802/7e_74j23d2a5f5j3bj31h70375gbeec1_100x100.png">
                </p>
            </div>
            <div class="record"><?php echo ($datas['copyright']); ?>&nbsp;
                <a href="http://s16.mogucdn.com/new1/v1/bmisc/518ea1bbd36948b90e658485d2700e62/181714310539.pdf" target="_blank">电信与信息服务业务经营许可证100798号</a>&nbsp;
                <a href="http://s16.mogucdn.com/p1/160811/idid_ifrtszjqmmzdazrumezdambqhayde_2436x3500.jpg" target="_blank">经营性网站备案信息</a>&nbsp;
                <br /><?php echo ($datas['record']); ?>&nbsp; 京公网安备110108006045&nbsp;&nbsp; 客服电话：4000-800-577&nbsp; 文明办网文明上网举报电话：010-82615762 &nbsp;
                <a href="http://net.china.com.cn/index.htm" target="_blank">违法不良信息举报中心</a></div>
            </div>
        </div>
        <p style="display: none" class="biu-login">11cnkktq</p>
        <div class="biu-sidebar">
            <div class="biu-options">
                <div class="biu-download">下载
                    <span>APP</span>
                    <div class="mls-qrcode">
                        <img src="/shop2/Public/Home/p2/160802/7e_0h22fa0g03cgl0c5676cb6k2ii71h_140x140.png">
                    </div>
                </div>
                <div class="biu-cart">
                  <a href="mycart.html" target="_blank">
                    <span class="cart-num biu-cart-num"></span>购物车</a>
                </div>
                <div class="biu-service">
                  <a class="biu-open-im">
                    <span class="service-num biu-service-num"></span>消息</a>
                </div>
                <div class="biu-coupon">
                  <a href="coupon.html#" target="_blank">
                    <span class="coupon-num biu-coupon-num"></span>优惠券</a>
                </div>
                <div class="biu-mark"><a href="mylike.html" target="_blank">收藏</a></div>
                <div class="biu-footprint"><a href="footprint.html" target="_blank">足迹</a></div>
            </div>
            <div class="biu-go2top"></div>
        </div>
    </div>
     
<script type="text/javascript" src="/shop2/Public/Home/js/index.js-417ef0a2.js"></script>

<script type="text/javascript" src="/shop2/Public/Home/js/index.js-800cd574.js"></script>


</body>
</html>