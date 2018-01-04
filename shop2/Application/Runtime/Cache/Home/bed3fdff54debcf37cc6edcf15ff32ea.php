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
  
     
<script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js?1.12.4" ></script>
<script type="text/javascript" src="/shop2/Public/Home/__static/logger/0.1.8/logger.js"></script>
<script src="/shop2/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
<script src="/shop2/Public/Home/pc/~page/pcenter/common/navbar+page/account/common/captcha+page/account/changeMobile/step1+base?1607171728.25"></script><script>fml.use('page/pcenter/common/navbar');;
fml.use('page/account/common/captcha');;
fml.use('page/account/changeMobile/step1');;
fml.use('base');;fml.iLoad();</script>


    
  <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171728.25" />     
<link rel="icon" href="/shop2/Public/Home/pic/_o/75/6e/2f6871f198c0bd7615ffbf9a2f5f_49_48.c5.png" type="image/x-icon"/>    
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/common.css?1607171728.25"/>
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/process.css?1607171728.25"/>
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/changeMobile.css?1607171728.25"/>
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/accountDialog.css?1607171728.25"/>
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/authpic.css?1607171728.25"/>       
<script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1" ></script>    

    

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
        <a target="_blank" href="<?php echo U('Cart/showMyCartView');?>" >
          <em class="cart"></em>我的购物车</a>
        <div class="hidden">
          <ul class="cart-goods"></ul>
          <p class="cart-account">
            <span>购物车里还有
              <a class="num" href="<?php echo U('Cart/showMyCartView');?>" target="_blank"></a>件商品</span>
            <a class="check-cart" href="<?php echo U('Cart/showMyCartView');?>" target="_blank">查看购物车</a></p>
        </div>
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
             <!--        <li><a class="" href="<?php echo U('Person/showOrderView', ['status' => 1]);?>">待付款(<?php echo ($priCount); ?>)</a></li>
                    <li><a class="" href="<?php echo U('Person/showOrderView', ['status' => 2]);?>" target="_blank">待收货(<x id="outer"><?php echo ($numCount); ?></x>)</a></li> -->
                    <li><a class="" href="<?php echo U('Person/showOrderView', ['status' => 3]);?>" target="_blank">待评价(<x id="inner"><?php echo ($conCount); ?></x>)</a></li>
                  <!--   <li><a class="" href="javascript:;" target="_blank">退款退货</a></li>
                    <li><a class="" href="javascript:;" target="_blank">订单回收站</a></li> -->
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
    <strong class="settings_title">邮箱绑定</strong> 

   
    <fieldset class="bindMobile"> 
        <!-- <form id="bindMobileForm" method="post" onsubmit="return false" action="http://www.meilishuo.com/account/changeMobile?token=19ad89e2973c4143ac1d74f527fe9a4a&amp;step=2&amp;ptp=1.vef4a.0.0.uFnL2hF"> 
            <div class="form-list"> 
                <label class="account-label" id="protel" for="mobile">新手机号</label> 
                <input class="lipt l_ipt" autocomplete="off" id="mobile" name="mobile" type="text"> 
                <input class="s_button active_button" type="button" name="s_code2" id="s_code2" value="发送验证码"> 
            </div> 图形验证码，可能需要 
            <div class="form-list" id="acptchaForm"> 
                <div class="authpic" id="authpic" data-captkay="j5drfreraoqs"> 
                    <div class="auth_box"> 
                        <p class="notice_title">请填写验证码 再进行验证！</p> 
                        <div class="pic_auth"> 
                            <ul class="pic_list"> 
                                <li data-click="0"><img style="left:-0px" src="./绑定_美丽说_files/j5drfreraoqs"></li> 
                                <li data-click="0"><img style="left:-68px" src="./绑定_美丽说_files/j5drfreraoqs"></li> 
                                
                            </ul> 
                            <a class="change_pic" id="change_pic" href="javascript:;"> 换一组 </a> 
                        </div> 
                    </div>
                </div> 
            </div> 
            <div class="form-list none" id="yanzhengma"> 
                <label for="code" class="account-label">验证码</label>
                <input class="lipt l_ipt" autocomplete="off" id="code" name="code" type="text" value=""> 
                <strong></strong> 
            </div> 
            <div class="sendErrorMsg color-pink">请不要填写和当前一样的手机号</div> 
            <div class="submitBox none">  
        
                <input id="change_bind" data-token="19ad89e2973c4143ac1d74f527fe9a4a" name="change_bind" class="ext_submit" type="submit" value="下一步"> <span class="bindErrorMessage color-pink"></span> 
            </div> 
        </form>  
         -->

<form id="bindMobileForm" method="post" onsubmit="return false" action="">  
    <div class="form-list"> 
        <label class="account-label" id="protel" for="mobile">原手机号</label> 
        <input class="lipt l_ipt bgc-f7" autocomplete="off" value="188****3162" disabled id="mobile" name="mobile" type="text" /> 
        <input class="s_button active_button" type="button" name="s_code" id="s_code" style="" value="发送验证码" /> 
        
    </div> <!-- 图形验证码，可能需要 --> 

    <div  class="form-list" id="yanzhengma"> 
        <label class="account-label" for="code" >验证码</label> 
        <input id="code" name="code" type="text" value="" /> 
        <strong></strong> 
    </div> 
    <div > 
        <a href="<?php echo U('Person/newMail');?>"><button id="send_next" name="s_bind" class="ext_submit" type="button" value="下一步"/>下一步</button></a>
            <span class="bindErrorMessage color-pink"></span> 
    </div> 
</form> 


</filedset> 
<div class="bie-info"> 
    <p> 说明： </p> <p> 1.修改绑定邮箱后，原邮箱将不能用于登录。您可以使用更换后的邮箱进行登录。 </p> <p> 2.若因手机号丢失无法进行验证，请联系美丽说客服。 </p> 
</div> 
</div>









<script type="text/html" id="process"> 
<ul class="process"> <? $.map(this.steps, function(step, index){ ?> <li class="<?= step.done?'active':'' ?>" style="width:<?= this.line_length?>px"><?= step.msg?></li> <? }); ?> </ul>
</script>




<!-- 弹窗 --><script type="text/html" id="accountDialog"> <div class="popup" id="popup"> <div class="box"> <p class="title"> <?= this.title ?> <a href="javascript:;" class="bg-icons"></a> </p> <p class="tips"><?= this.message ?></p> <div class="btn-box"> <? this.buttons.forEach(function(item){ ?> <a href="javascript:;" data-action="<?= item.action ?>" class="btn-pink btn"><?= item.text ?></a> <? }); ?> </div> </div> <i></i> </div></script>



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
     
<script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js?1.12.4" ></script>
<script type="text/javascript" src="/shop2/Public/Home/__static/logger/0.1.8/logger.js"></script>
<script src="/shop2/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
<script src="/shop2/Public/Home/pc/~page/pcenter/common/navbar+page/account/common/captcha+page/account/changeMobile/step1+base?1607171728.25"></script><script>fml.use('page/pcenter/common/navbar');;
fml.use('page/account/common/captcha');;
fml.use('page/account/changeMobile/step1');;
fml.use('base');;fml.iLoad();</script>


</body>
</html>