<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        
        
    </title>

    <meta name="description" content="<?php echo ($datas['desc']); ?>" />
    <meta name="keywords" content="<?php echo ($datas['keywords']); ?>" />
    <!-- <link rel="icon" href="/shop2/Public/Uploads/<?php echo ($datas['icon']); ?>" type="image/x-icon" /> -->

        <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171729.25" />
   
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/common.css?1607171729.25" />
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/datepicker.css?1607171729.25" />
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/setPersonal.css?1607171729.25" />
    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1"></script>    
  
    
    <!-- 预留一个位置，用于子模板加载与其他模板不同的js -->
    
          
        <!-- 预留一个位置，用于子模板加载与其他模板不同的样式 -->
    

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
<?php
 if ($logout) { $url = '/shop2/Home/Login'; }else{ $url = '/shop2/Home/Person'; } ?>
<body>
    <div class="head">
        <div id="com-topbar">
            <div class="inner">
                <ul>
                    <li class="drop" style="float:left">
                        <a href="<?php echo U('Index/index');?>" ><em class="home"></em>美丽说首页</a>
             
                    </li>
                    <li class="drop">
                        <a href="<?=$url?>" class="nick" target="_blank">
                        <img class="face" src="http://s2.mogucdn.com/new1/v1/bdefaultavatar/03.jpg" />
                        <?php if(($logout == 1)): ?>请登录
                        <?php else: ?>
                            <?php echo ($user['account']); endif; ?>
                        <em class="arrow"></em></a>
                        <ul class="down account">
                            <li>
                                <a href="<?=$url?>" >账号与安全</a>
                            </li>
                            <li>
                                 <a href="javascript:;" onclick="setLogout()" <?=$logout?'style="display:none"':''?>>退出</a></li>
                            </li>
                        </ul>
                    </li>
                    <li class="drop">
                        <a href="mylike.html" target="_blank">
                          <em class="collect"></em>我的收藏
                        </a>
                        <ul class="down">
                          <li><a href="mylike.html" target="_blank">收藏宝贝</a></li>
                          <li><a href="mylikestore.html" target="_blank">收藏店铺</a></li>
                        </ul>
                    </li>
                    <li class="drop cart-wrapper">
                        <a target="_blank" href="mycart.html">
                          <em class="cart"></em>我的购物车
                        </a>
                        <div class="hidden">
                          <ul class="cart-goods"></ul>
                          <p class="cart-account">
                            <span>购物车里还有
                              <a class="num" href="mycart.html" target="_blank"></a>件商品</span>
                            <a class="check-cart" href="mycart.html" target="_blank">查看购物车</a></p>
                        </div>
                    </li>
                    <li>
                        <a href="orderlist.html" target="_blank">
                          <em class="order"></em>我的订单</a>
                    </li>
        <!--             <li class="drop">
                        <a target="_blank">帮助中心
                            <em class="arrow"></em>
                        </a>
                        <ul class="down">
                          <li>
                            <a href="buyerService.html" target="_blank">买家服务</a></li>
                          <li>
                            <a href="#/help#/index" target="_blank">商家服务</a></li>
                          <li>
                            <a href="ruleCenter.html" target="_blank">规则中心</a></li>
                        </ul>
                    </li>
                    <li><a href="#" target="_blank" class="last">商家后台</a></li> --> 
                </ul>
            </div>
        </div>
          
          
        <div id="com-search">
            <div class="inner">
                <a href="index.html" class="logo">
                    <img src="/shop2/Public/Uploads/<?php echo ($datas['icon']); ?>" alt="" width="204px" height="52px">
                </a>
                <a href="" class="sublogo"></a>
                <div class="search">
                     <div class="search-tab">
                        <span class="active">宝贝</span>
                    </div>
                    <div class="search-box">
                        <input type="text" class="search-txt">
                        <span class="search-btn"></span>
                        <div class="suggest-box"></div>
                    
                    </div>
                    <div class="hotword"></div>
                </div>
                <a class="spread" href="" target="_blank">
                   <!--  <img src="http://s6.mogucdn.com/p2/160804/1rp_49cgihk50031c69jjk51ilkjk4950_210x157.gif" /> -->
                </a>
            </div>
        </div>
        <div class="nav_main_box">
            <ul class="nav_main">
                <li class="all">全部商品
                    
                    
                </li>
            </ul>
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
                  console.log('注销没');
              }
          },
          error:function(msg){
              layer.confirm('访问服务器失败.');
          },
          dataType:'json'
      });
    }
    

</script>

    
    <!-- 预留一个位置，用于子模板加载与其他模板不同的js -->
    
</body>
</html>