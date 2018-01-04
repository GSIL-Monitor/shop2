<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        宝贝收藏
    </title>

    <meta name="description" content="<?php echo ($datas['desc']); ?>" />
    <meta name="keywords" content="<?php echo ($datas['keywords']); ?>" />
    <link rel="icon" href="/shop2/Public/Uploads/<?php echo ($datas['icon']); ?>" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171729.25" />
   
  
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/datepicker.css?1607171729.25" />

    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1"></script>    
   <script type="text/javascript" src="/shop2/Public/Home/js/jquery-1.12.3.min.js"></script>
    
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171728.25" />
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/pcenter/common.css?1607171728.25"/>
<link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/pcenter/mylike.css?1607171728.25"/>
<script src="/shop2/Public/js/jquery-1.9.1.min.js"></script> 
<script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>

    
<script type="text/javascript">
    $('.delete-like').click(function(){
        var obj = $(this);
        console.log(obj.attr('cid'));
        var cid = obj.attr('cid');
        layer.confirm('是否移除收藏',{btn:['确定','取消']},
            function(index){
                $.ajax({
                    type:'get',
                    url:"<?php echo U('Collect/delCollect');?>",
                    data:'cid='+cid,
                    success:function(msg){
                        if (msg['code'] ==1200) {
                            layer.msg('删除了',{icon:1,time:800});
                            location.reload([true]);
                        }else if(msg['code'] ==1404){
                            layer.msg(msg['msg'],{icon:1,time:800});
                        }
                    },
                    error:function(msg){
                        layer.msg('服务器异常',{icon:1,time:800});
                    },
                    dataType:'json'
                }); 
            }
        );
    });
</script>


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
        "controller": "welcome",
        "isLogin": true,
        "userInfo": {
          "name": "阿猫来了",
          "uid": "11cnkktq",
          "avatar": "http://s2.mogucdn.com/new1/v1/bdefaultavatar/03.jpg" 
        }
      }
    };
    </script>




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
                <a href="<?php echo U('Index/index');?>" class="logo">
                    <img src="/shop2/Public/Uploads/<?php echo ($datas['icon']); ?>" alt="" width="204px" height="52px">
                </a>
                <a href="" class="sublogo"></a>
                <div class="search">
                     <div class="search-tab">
                        <span class="active">宝贝</span>
                    </div>
                    <div class="search-box">
                        <form action="<?php echo U('List/index');?>" method="get">
                        <input type="text" class="search-txt"  name="keyword" value="<?php echo ($keyword); ?>">
                        <button   class="search-btn" style="border:0"></button>
                
                        </form>



                        <div class="sugges-box">
         
                       
                        </div>
                    </div>
                    <div class="hotwords">
                       <?php  vendor('xunsearch.lib.XS'); $xs = new \XS('shop2'); $sObj = $xs->search; $hot = $sObj->getHotQuery(4,'currnum'); arsort($hot); foreach($hot as $k=>$v) { ?>

                    <a href="<?php echo U('List/index',array('keyword'=>$k));?>" style="color:#ff3366"><?php echo ($k); ?></a>
                        <?php }?>  
                
   


                    </div>
                </div>

                <a class="spread" href="" target="_blank">
                      <embed src="/shop2/Public/Home/img/honehone_clock_wh.swf" style=" height:58px; width:155px;position:absolute;left:1023px; top:27px"></embed>
                    

                   <!--  <img src="http://s6.mogucdn.com/p2/160804/1rp_49cgihk50031c69jjk51ilkjk4950_210x157.gif" /> -->
                </a>
            </div>
        </div>

                <div class="nav_main_box">
                    
           
                    
  
                    </div>
                </div>
    
<div class="pcenter">
    <div class="collect_nav">
        <a href="javascript:;" class="active">收藏的宝贝</a>
    </div>
    <div class="collect-title">
        <ul>
            <li>
                <a href="javascript:;" class="active">全部 <span><?php echo ($count); ?></span></a>
            </li>
        </ul>
    </div>
    <div class="mylike_content" id="mylike_content">
        <!-- 循环开始 -->
        <?php if(is_array($data)): foreach($data as $key=>$ov): $id = $ov['goods_id']; $goods = D('goods')->where(['id'=>$id])->field('name,price,pic')->find(); ?>
        <div class="one-goods ">
            <a class="img-panel" href="<?php echo U('Goods/showDetailView',[id=>$ov['goods_id']]);?>" target="_blank"><img src="/shop2/Public/Uploads/<?=$goods['pic']?>" alt="">
            </a>
            <span class="delete-like" cid="<?php echo ($ov['id']); ?>"><em></em></span>
            <div class="cost-and-salenum">
                <span class="goods-cost">￥<?php echo ($goods['price']); ?></span>
                <span class="sale-num"><?php echo ($ov['addtime']); ?></span>
            </div>
            <a class="title-panel" href="<?php echo U('Goods/showDetailView',[id=>$ov['goods_id']]);?>" target="_blank"><?=$goods['name']?></a>
        </div><?php endforeach; endif; ?>
        <!-- 循环结束 -->
        <div style="text-align:center;"><?php echo ($pageBtn); ?></div>
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
                <h4>友情链接</h4>
                <?php  $linkdatas = M('link')->where('status=1')->limit(3)->select(); foreach($linkdatas as $v) { ?>
                <div>
                    <a href="<?php echo ($v['url']); ?>" target="_blank">
                    <span class="i-qzone"><img src="/shop2/Public/Uploads/<?php echo ($v['pic']); ?>" style="height:20px;width:20px;"></span><?php echo ($v['name']); ?></a>
                </div>
                <?php }?>
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
   <script type="text/javascript">
                       
        
        $(".search-txt").keyup( function() {
            var tim =  $(".search-txt").val();
                   $('.sugges-box').children('div').remove();

        $.ajax({
              type:'post',
              url:"<?php echo U('Index/getRelatedQuery');?>",
              data:'val='+tim,
              success:function(msg){
                  if (msg['code'] == 1200) {
                      if(msg.data['length'] != 0){
                        $('.sugges-box').show();
                     
                for (var i in msg.data) {
                var ulStr = '';
                // "<div class='item'>"+msg.data[i]+"</div>";  
                ulStr +=  "<div class='item'><a href='<?php echo U('List/index','','');?>/keyword/"+msg.data[i]+"'>"+msg.data[i]+"</a></div>";        
                }   
                $('.sugges-box').append( ulStr );

                      } else {

                        $('.sugges-box').hide();
                      }
                  }
              },
       
              dataType:'json'
          });

    });
    </script>

    
<script type="text/javascript">
    $('.delete-like').click(function(){
        var obj = $(this);
        console.log(obj.attr('cid'));
        var cid = obj.attr('cid');
        layer.confirm('是否移除收藏',{btn:['确定','取消']},
            function(index){
                $.ajax({
                    type:'get',
                    url:"<?php echo U('Collect/delCollect');?>",
                    data:'cid='+cid,
                    success:function(msg){
                        if (msg['code'] ==1200) {
                            layer.msg('删除了',{icon:1,time:800});
                            location.reload([true]);
                        }else if(msg['code'] ==1404){
                            layer.msg(msg['msg'],{icon:1,time:800});
                        }
                    },
                    error:function(msg){
                        layer.msg('服务器异常',{icon:1,time:800});
                    },
                    dataType:'json'
                }); 
            }
        );
    });
</script>

</body>
</html>