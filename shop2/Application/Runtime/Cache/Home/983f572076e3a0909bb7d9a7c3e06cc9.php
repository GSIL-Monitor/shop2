<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>最新美丽说网购平台模板</title>
    <meta name="description" content="美丽说是白领女性时尚消费第一品牌，为超过1亿注册用户提供导购信息。建立300万全球女性时尚品牌商品库，超过1000家全球品牌达成官方合作导购体验，更好的满足白领女性的时尚消费需求。" />
    <meta name="keywords" content="美丽说,美丽说官网,美丽说首页,美丽说登录,导购,白领,女装,网购" />
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607170150.25" />
    <link rel="icon" href="/shop2/Public/Home/pic/_o/75/6e/2f6871f198c0bd7615ffbf9a2f5f_49_48.c5.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/welcome.css?1607170150.25" />
    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js"></script>
    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1"></script>
    <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
 
    <script>fml.setOptions({
      'sversion': '1607170150.25',
      'defer': true,
      'modulebase': '/shop2/Public/Home/pc/jsmin/'
    });
    var Meilishuo = {
      "config": {
        "nt": "1yQyN1tU7ssTVQ5GeZ16w7IF/0VPJbAp1lO2BxZa52X2e4+pti0UtSulDoUBzzqn",
        "main_site_domain": "/",
        "server_url": "/",
        "picture_url": "#",
        "captcha_url": "#",
        "im_url": "http://imlab.meilishuo.com/",
        "forSale": false,
        "controller": "welcome",
        "isLogin": true,
        "userInfo": {
          "name": "阿猫来了",
          "uid": "11cnkktq",
          "avatar": "/shop2/Public/Home/new1/v1/bdefaultavatar/03.jpg"
        }
      }
    };
    </script>
</head>

<body>
<div class="head">
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
        <a target="_blank" href="mycart.html" class="my-cart">
          <em class="cart"></em>我的购物车</a>
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
    <!--  -->
    <div id="top1" style="display:none;position:relative"><a href="<?php echo ($ad['link']); ?>"><img src="/shop2/Public/Uploads/<?php echo ($ad['pic']); ?>" width="1320" height="60" /></a>
        <span><img src="/shop2/Public/Home/close2.png" onclick="hides()" style="position:absolute;top:0px;right:40px;cursor:pointer;width:30px;height:30px;z-index:232"></span>


    </div>
    <div id="banner1" style="width:1340px; height:161px;display:none;"><img src="/shop2/Public/Uploads/<?php echo ($ad['pic']); ?>" width="1340" height="161" /></div>

   <!--  <img src="/shop2/Public/Home/jls.png" id="viva" style="position:absolute;top:200px;right:40px;cursor:pointer;width:83px;height:112px;z-index:232"> -->
    <!--  -->
            <!-- 搜索 -->
    <div id="com-search">
        <div class="inner">
            <a href="index.html" class="logo">
                <img src="http://d02.res.meilishuo.net/pic/_o/50/a7/735e2614e3911e621f0446e54597_204_52.c5.png" alt="">
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
                <embed src="/shop2/Public/Home/img/honehone_clock_wh.swf" style=" height:58px; width:155px;position:absolute;left:1023px; top:27px"></embed>
            </a>
        </div>
    </div>
      <!-- 垂直菜单 -->
    <div class="nav_main_box">
        <ul class="nav_main">
            <li class="all">全部商品
             <!--  -->
                <div class="attr_box">
                    <ul class="sec_attr" id="option">
                        <?php if(is_array($types)): foreach($types as $key=>$vo): ?><li class="list" id="<?php echo ($vo['id']); ?>">
                            <div class="list_cont" >
                                <h4  class="nav_tle">
                                    <a href="<?php echo U('List/list',['id'=>$vo['id']]);?>"><span style="text-align:center"><?php echo ($vo['name']); ?></span></a>
                                </h4>
                                <samp class="corner">
                                    <img src="/shop2/Public/Home/p1/160810/idid_ifrtom3dmqygcojumezdambqhayde_6x10.png" />
                                </samp>
                            </div>
                            <ul class="nav_list">
                                <li>
                                    <h4><a>所有分类</a></h4>
                                    <p class="pool"></p>
                                </li>
                            </ul>
                        </li><?php endforeach; endif; ?>   
                    </ul>
                </div>
            <!--  -->
            </li>
        </ul>
          
    </div>
</div>

<div class="top_wrap">

    <div class="banner_box" id="banner">
        <div class="top_bnr">
        <ul class="banner">
        <?php if(is_array($momo)): foreach($momo as $key=>$v): ?><li>
                <a class="pic imgBox" name="秋款新装" href="<?php echo U('List/list',['id'=>$v['link']]);?>"  style="background: repeat center top;">
                  <span asrc="/shop2/Public/Uploads/<?php echo ($v['pic']); ?>" width="895px" height="477px"></span>
                </a>
            </li><?php endforeach; endif; ?>
           
        </ul>
        </div>
        <div class="num"></div>
        <div class="bnr_btn_wrap">
            <span class="bnr_btn prev"></span>
            <span class="bnr_btn next"></span>
        </div>
    </div>

        <!-- 促销模块 -->
<!-- 
        <div style="margin-top:40px">
            
            <img src="/shop2/Public/Home/01.jpg" width="1200px" height="285px">
        </div> -->

    <ul class="top_ad_box">
        <li>
            <a class="imgBox">
              <span asrc="/shop2/Public/Home/p2/160817/1w9_394l8jf9f1h1ia6d531ca55g3ai85_285x285.jpg"></span>
            </a>
        </li>
        <li>
            <a href="dailynew.html?mt=12.12313.r121674.15248&acm=1.mce.2.12313.0.0.15248_121674" target="_blank" class="imgBox">
              <span asrc="/shop2/Public/Home/p2/160817/1s4_6kg07adibhf1gd439ek814dh3hghe_285x285.jpg"></span>
            </a>
        </li>
        <li>
            <a href="daimaiPCrukou.html?pstrc=fe_pos%3Awlc_ico_0&ptp=1.YUGqAYIU.0.0.iwTQx&mt=12.12313.r121675.15248&acm=1.mce.2.12313.0.0.15248_121675" target="_blank" class="imgBox">
              <span asrc="/shop2/Public/Home/p2/160811/1c2_224flc4959l243jibb0ab39cg89cf_285x285.jpg"></span>
            </a>
        </li>
        <li class="mr0">
            <a href="newbags.html?underwear1?mt=12.12313.r121676.15248&acm=1.mce.2.12313.0.0.15248_121676" target="_blank" class="imgBox">
              <span asrc="/shop2/Public/Home/p2/160810/1s6_2797cc0c7i6aka37g8ag34bjf27ib_285x285.jpg"></span>
            </a>
        </li>
    </ul>

   

    <h2 alt="热销上衣" ><img src="/shop2/Public/Home/p2/160810/1sy_7kgkelaf2k0kh060dbh8d6cife273_150x71.jpg"></h2>
    <div class="common_box" id="clothes" class="yifu">
        <div class="ad_t">
            <a class="ad1 imgBox">
                <img src="/shop2/Public/Home/p2/160810/1sd_3fbhd1ia7e5ah485ia02g7e7gcg44_590x284.png" >
            </a>

            <a class="ad2imgBox" href="">
                <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
            <a class="ad2imgBox" href="">
                <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>

            </a>
            <a class="ad2imgBox" href="">
                <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>

            </a>

        </div>
        <div class="ad_b">
            <div class="ad_attr_box">
                 <?php if(is_array($arr1)): foreach($arr1 as $key=>$vo): ?><a href="<?php echo U('List/list',['id'=>$vo['id']]);?>" target="_blank" 
                    <?php if($vo['id']%2==0) echo "class='red'";?> ><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>
            </div>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160804/1sd_50g38el56kaf9c0j30a2cdd6gde3k_285x220.png"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160810/1sd_3i4hiikak3hll547fcj7c48c1b71b_285x220.png"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160810/1sd_51g7j8k7gh6kleh254gkjahcfd827_285x220.png"></span>
            </a>
        </div>
    </div>

    <h2 alt="时髦美裙"><img src="/shop2/Public/Home/p2/160810/1sy_5b6aikjb3cgdk9jj8j65h5dafh13i_150x71.jpg"></h2>
    <div class="common_box" id="dress" class="yifu">
        <div class="ad_t">
            <a class="ad1 imgBox">
                <span asrc="/shop2/Public/Home/p2/160810/1sy_086081299j6gkilaiaic0k1c73a6k_590x284.jpg"></span>
            </a>
            <a href="list.html#10057275?action=skirt&mt=12.13046.r127215.16255&acm=1.mce.2.13046.0.0.16255_127215" class="ad2 imgBox" target="_blank">
             <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
            <a href="list.html#10057280?action=skirt&mt=12.13046.r127216.16255&acm=1.mce.2.13046.0.0.16255_127216" class="ad2 imgBox" target="_blank">
              <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
            <a href="list.html#10057277?action=skirt&mt=12.13046.r127219.16255&acm=1.mce.2.13046.0.0.16255_127219" class="ad2 imgBox" target="_blank">
              <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
        </div>
        <div class="ad_b">
            <div class="ad_attr_box">
                <?php if(is_array($arr2)): foreach($arr2 as $key=>$vo): ?><a href="<?php echo U('List/list',['id'=>$vo['id']]);?>" target="_blank" 
                    <?php if($vo['id']%2==0) echo "class='red'";?> ><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>
            </div>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160804/1sy_0k11eeecc0aj2e99gak95d2fjec4c_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160804/1sy_7k4f7l86d7akj2ch6che3h885bhk0_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160804/1sy_648g2318gi9ga53l85lihekda88d0_285x220.jpg"></span>
            </a>
        </div>
    </div>

    <h2 alt="精选裤子"><img src="/shop2/Public/Home/p2/160810/1sy_6g3edk5k669kac3fbfd0ch589b895_150x71.jpg"></h2>
    <div class="common_box" id="pant" class="yifu">
        <div class="ad_t">
            <a class="ad1 imgBox">
              <span asrc="/shop2/Public/Home/p2/160817/upload_89k2gkhjejg2dkf9l6ae894374eb8_590x284.jpg"></span>
            </a>
            <a href="list.html#10057367?action=trousers&mt=12.13047.r127739.16256&acm=1.mce.2.13047.0.0.16256_127739" class="ad2imgBox" target="_blank">
                <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
            <a href="list.html#10057370?action=trousers&mt=12.13047.r127741.16256&acm=1.mce.2.13047.0.0.16256_127741" class="ad2imgBox" target="_blank">
              <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
            <a href="list.html#10057382?action=trousers&mt=12.13047.r127743.16256&acm=1.mce.2.13047.0.0.16256_127743" class="ad2imgBox" target="_blank">
              <img src="/shop2/Public/Home/timg.gif" width="184px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;padding:8px 4px 0;text-align:center"></div>
            </a>
        </div>
        <div class="ad_b">
            <div class="ad_attr_box">
                <?php if(is_array($arr3)): foreach($arr3 as $key=>$vo): ?><a href="<?php echo U('List/list',['id'=>$vo['id']]);?>" target="_blank" 
                    <?php if($vo['id']%2==0) echo "class='red'";?> ><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>
            </div>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160804/1s3_2d2e0l2i5h6bja3c56eh6c1k21eeh_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160809/1s3_01gf2b05jkj3icec24hk6cl827kah_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/shop2/Public/Home/p2/160809/1s3_2913k8dda5ha42407f3e911cg080d_285x220.jpg"></span>
            </a>
        </div>
    </div>



    <div class="zhanwei"></div>
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
                <a href="#" target="_blank"><span class="i-sina"></span>新浪微博</a>
            </div>
            <div>
                <a href="#" target="_blank"><span class="i-qzone"></span>QQ空间</a>
            </div>
            <div>
                <a href="#" target="_blank"><span class="i-tencent"></span>腾讯微博</a>
            </div>
        </div>
        <div class="flist service">
            <h4>美丽说微信服务号</h4>
            <img class="qrcode" src="/shop2/Public/Home/p2/160802/7e_61hjl8kjfjfagkg3cdaj05fghck9c_100x100.png" alt="美丽说服务号二维码" />
        </div>
        <div class="flist last" style="float:left;">
            <h4>美丽说客户端下载</h4>
            <p style="background:none; margin-top:0px;" class="client">
                <img class="qrcode" src="/shop2/Public/Home/p2/160802/7e_74j23d2a5f5j3bj31h70375gbeec1_100x100.png">
            </p>
        </div>
        <div class="record">Copyright ©2016 Meilishuo.com &nbsp;
            <a href="/shop2/Public/Home/new1/v1/bmisc/518ea1bbd36948b90e658485d2700e62/181714310539.pdf" target="_blank">电信与信息服务业务经营许可证100798号</a>&nbsp;
            <a href="/shop2/Public/Home/p1/160811/idid_ifrtszjqmmzdazrumezdambqhayde_2436x3500.jpg" target="_blank">经营性网站备案信息</a>&nbsp;
                <br />京ICP备11031139号&nbsp; 京公网安备110108006045&nbsp;&nbsp; 客服电话：4000-800-577&nbsp; 文明办网文明上网举报电话：010-82615762 &nbsp;
            <a href="http://net.china.com.cn/index.htm" target="_blank">违法不良信息举报中心</a>
        </div>
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
                <span class="cart-num biu-cart-num"></span>购物车
            </a>
        </div>
        <div class="biu-service">
            <a class="biu-open-im">
                <span class="service-num biu-service-num"></span>消息
            </a>
        </div>
        <div class="biu-coupon">
            <a href="coupon.html#" target="_blank">
                <span class="coupon-num biu-coupon-num"></span>优惠券
            </a>
        </div>
        <div class="biu-mark">
            <a href="mylike.html#" target="_blank">收藏</a>
        </div>
        <div class="biu-footprint">
            <a href="footprint.html#" target="_blank">足迹</a>
        </div>
    </div>
    <div class="biu-go2top"></div>
</div>

<script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js"></script>

<script type="text/javascript" src="/shop2/Public/Home/__static/logger/0.1.8/logger.js"></script>
<script src="/shop2/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
<script src="/shop2/Public/Home/pc/~page/welcome+base?1607170150.25"></script>
<script>fml.use('page/welcome');;
    fml.use('base');;
    fml.iLoad();</script>
<script type="text/javascript">
    $('#option li').mouseenter(function(){
        var that = $(this);
        var cateId = $(this).attr('id');
        if (that.attr('box') == 'true') {
            return false;
        }
        $.post(
            "<?php echo U('getSonType');?>",
            {cate_id: cateId},
            function (msg) {
                if (msg.code == 1200) {
                    var ulStr = '';
                    for (var i in msg.data) {
                    ulStr += "<a href='<?php echo U('List/list');?>?id="+msg.data[i].id+"'>"+ msg.data[i].name +'</a>';          
                    }   

                    $('#option').children('li').eq( that.index() ).find('p').append( ulStr );               
                    that.attr('box','true');
                } else {                   
                
                }
            },
            'json'
        );

    })

    
$(document).ready(function(){
    $("#banner1").slideDown("slow"); /*下拉速度 可自己设置*/
});

function displayimg(){
    $("#banner1").slideUp(1000,function(){
    $("#top1").slideDown(1000,function(){

    setTimeout(function(){
        $('#top1').hide();  
    },2000); /*下拉速度 可自己设置*/
    }); 
})}

setTimeout("displayimg()",2000);
function hides(){
    $('#top1').hide();
}


var w = 180;
bb(w);
function bb(w)
{
    var timer = setInterval(function() {
        w++;
        if (w >= 300) {
            clearInterval(timer);
             aa(w);
        } else {
            $('#viva').css({'top':w+'px'});
        }
    }, 8);

}

function aa(w)
{
    var timer = setInterval(function() {
        w--;
        if (w <= 180) {
            clearInterval(timer);
             bb(w);
        } else {
          $('#viva').css({'top':w+'px'});

        }
    }, 8);

}

    // $(function(){
    //     var top = $('#yifu').offset().top - $(window).height(); // offset().top 元素页面的高度 - 浏览器的窗口高度
        
    //     $(window).scroll(function(){
    //         var sclST = $(window).scrollTop();// 滚动高度
    //         if( sclST > top ){
    //             console.log('衣服衣服');
    //         }
    //     });
    // })



    // $(function(){
    //     var top = $('#qunzi').offset().top - $(window).height(); // offset().top 元素页面的高度 - 浏览器的窗口高度
        
    //     $(window).scroll(function(){
    //         var sclST = $(window).scrollTop();// 滚动高度
    //         if( sclST > top ){
    //             console.log('裙子');
    //         }
    //     });
    // })



var flag1 = true;
var flag2= true;
var flag3 = true;
$(window).scroll(function(){
    if (flag1) {
        var sclST = $(window).scrollTop();// 滚动高度
        var top1 = $('h2').first().offset().top - $(window).height(); // offset().top 元素页面的高度 - 浏览器的窗口高度

        if( sclST > top1 && $('h2').first().attr('boxes') != 'true'){
            flag1 = false;
            $.post(
            "<?php echo U('getHotGoods');?>",
            {id: 1},
            function (msg) {
                if (msg.code == 1200) {
                    var num = msg.data.length;
                 for (var i = 0; i < num; i++) { 
                  $('h2').first().next().find(".ad2imgBox").eq(i).find('img').attr('src','/shop2/Public/Uploads/'+msg.data[i].pic);
                  $('h2').first().next().find(".ad2imgBox").eq(i).find('div').html(msg.data[i].name);
                  $('h2').first().next().find(".ad2imgBox").eq(i).attr('href',"<?php echo U('Goods/detail');?>?id="+msg.data[i].id);
                }
                    $('h2').first().attr('boxes','true');

                    flag1 = true;

                    } else {
                        //没有拿到商品数据
                    }
                },
                'json'
            );
        }
    }   
  /*  if (flag2) {
        var sclST = $(window).scrollTop();// 滚动高度
        var top1 = $('h2').eq(1).offset().top - $(window).height(); // offset().top 元素页面的高度 - 浏览器的窗口高度

        if( sclST > top1 && $('h2').eq(1).attr('boxes') != 'true'){
            flag2 = false;
            $.post(
            "<?php echo U('getHotGoods');?>",
            {id: 2},
            function (msg) {
                if (msg.code == 1200) {
                    // var ui = $('h2').eq(1).next().attr('id');
                    // console.log(ui);
                   console.log($('h2').first().next().find("a").find('img').attr('src'));

                    $('h2').eq(1).attr('boxes','true');


                    flag2 = true;

                    } else {
                        //没有拿到商品数据
                    }
                },
                'json'
            );
        }
    }   */
   /* if (flag3) {
        var sclST = $(window).scrollTop();// 滚动高度
        var top1 = $('h2').last().offset().top - $(window).height(); // offset().top 元素页面的高度 - 浏览器的窗口高度

        if( sclST > top1 && $('h2').last().attr('boxes') != 'true'){
            flag3 = false;
            $.post(
            "<?php echo U('getHotGoods');?>",
            {id: 3},
            function (msg) {
                if (msg.code == 1200) {
                    var ui = $('h2').last().next().attr('id');
                    console.log(ui);
                    $('h2').last().attr('boxes','true');

                    flag3 = true;

                    } else {
                        //没有拿到商品数据
                    }
                },
                'json'
            );
        }
    }*/
})

/*var flag = true;
$(window).scroll(function(){
    if (flag) {
        var sclST = $(window).scrollTop();// 滚动高度
        $('h2').each( function(i){
            var that = $(this);
            var top = that.offset().top - $(window).height(); // offset().top 元素页面的高度 - 浏览器的窗口高度
            if (that.attr('boxes') != 'true' && sclST > top) {
                flag = false;
                $.post(
                "<?php echo U('getHotGoods');?>",
                {id: i+1},
                function (msg) {
                    if (msg.code == 1200) {
                        // var ui = that.next().attr('id');
                        // console.log(ui);
                        that.next().find("a.ad2 imgBox").find('span').css({'asrc':'2.jpg'});
                        that.attr('boxes','true');
                        flag = true;

                        } else {
                            //没有拿到商品数据
                        }
                    },
                    'json'
                );
            }
        });
    }
});*/



</script>

</body>

</html>