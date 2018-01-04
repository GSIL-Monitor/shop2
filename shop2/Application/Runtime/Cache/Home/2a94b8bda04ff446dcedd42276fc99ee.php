<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        <?php echo ($datas['title']); ?>
    </title>

    <meta name="description" content="<?php echo ($datas['desc']); ?>" />
    <meta name="keywords" content="<?php echo ($datas['keywords']); ?>" />
    <link rel="icon" href="/Public/Uploads/<?php echo ($datas['icon']); ?>" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="/Public/Home/pc/css/base.css?1607171729.25" />
   
  
    <link rel="stylesheet" type="text/css" href="/Public/Home/pc/css/page/account/datepicker.css?1607171729.25" />

    <script type="text/javascript" src="/Public/Home/pc/jsmin/fml.js?1"></script>    
   <script type="text/javascript" src="/Public/Home/js/jquery-1.12.3.min.js"></script>
    

    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" />
    <link rel="icon" href="/Public/Home/pic/_o/75/6e/2f6871f198c0bd7615ffbf9a2f5f_49_48.c5.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/pc/css/page/welcome.css?1607170150.25" />
    <script type="text/javascript" src="/Public/Home/pc/jsmin/jquery.js"></script>
    <script src="/Public/assets/layer/layer.js" type="text/javascript" ></script>

    
    <script type="text/javascript" src="/Public/Home/pc/jsmin/jquery.js"></script>

    <script type="text/javascript" src="/Public/Home/__static/logger/0.1.8/logger.js"></script>
    <script src="/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
    <script src="/Public/Home/pc/~page/welcome+base?1607170150.25"></script>
    <script>fml.use('page/welcome');;
        fml.use('base');;
        fml.iLoad();
    </script>

<script type="text/javascript">

        
var marke = 1;
setInterval(function() {

   
    if (marke > 0) {
    $('.qiang').css({"color":"white","background-color":"#e01222"});
       
    } else {
      
    $('.qiang').css({"color":"#e01222","background-color":"white"});
    }
    marke = -marke;


}, 400);


</script>

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
                    ulStr += "<a href='<?php echo U('List/index','','');?>/tid/"+msg.data[i].id+"'>"+ msg.data[i].name +'</a>';          
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


    var w = 300;
    bb(w);
    function bb(w)
    {
        var timer = setInterval(function() {
            w++;
            if (w >= 450) {
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
            if (w <= 300) {
                clearInterval(timer);
                 bb(w);
            } else {
              $('#viva').css({'top':w+'px'});

            }
        }, 8);

    }

    function toVip(obj,uid,role){
        // console.log(uid);
        // console.log(role);
        $.post(
            "<?php echo U('Index/beVip');?>",
            {uid: uid, role: role},
            function (msg) {
                if (msg.code == 1200) {
                   
                } else {                   
                
                }
            },
            'json'
        );
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


var flag = true;
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
                    var num = msg.data.length;
                    console.log(num);
                     for (var w = 0; w < num; w++) { 

                      $('h2').eq(i).next().find(".ad2imgBox").eq(w).find('img').attr('src','/Public/Uploads/'+msg.data[w].pic);
                      $('h2').eq(i).next().find(".ad2imgBox").eq(w).find('div').html(msg.data[w].name);
                      $('h2').eq(i).next().find(".ad2imgBox").eq(w).attr('href',"<?php echo U('Goods/showDetailView','','');?>/id/"+msg.data[w].id);
                    }
                    $('h2').eq(i).attr('boxes','true');

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
});
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
 

    <script>fml.setOptions({
      'sversion': '1607171729.25',
      'defer': true,
      'modulebase': '/Public/Home/pc/jsmin/'
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
        
           <?php if(empty($picc)): ?><img class="face" src="/Public/Home/new1/v1/bdefaultavatar//03.jpg" />
            <?php else: ?>
            <img class="face" src="/Public/Uploads/<?php echo ($picc); ?>"><?php endif; ?>
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


        
          
  <!--   <div id="top1" style="display:none;position:relative"><a href="<?php echo ($ad['link']); ?>"><img src="/Public/Uploads/<?php echo ($ad['pic']); ?>" width="1320" height="60" /></a>
        <span><img src="/Public/Home/close2.png" onclick="hides()" style="position:absolute;top:0px;right:40px;cursor:pointer;width:30px;height:30px;z-index:232"></span>
    </div>
    <div id="banner1" style="width:1340px; height:161px;display:none;"><img src="/Public/Uploads/<?php echo ($ad['pic']); ?>" width="1340" height="161" /></div>
    <?php if(empty($uid)): else: ?>
    <a href="<?php echo U('Index/oodex');?>"><img src="/Public/Home/jls.png" id="viva" title="点击充会员" onclick="toVip(this,<?php echo ($uid); ?>,<?php echo ($role); ?>)"style="position:absolute;right:60px;cursor:pointer;width:83px;height:102px;z-index:232"></a><?php endif; ?> -->


        <div id="com-search">
            <div class="inner">
                <a href="<?php echo U('Index/index');?>" class="logo">
                    <img src="/Public/Uploads/<?php echo ($datas['icon']); ?>" alt="" width="204px" height="52px">
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
                      <embed src="/Public/Home/img/honehone_clock_wh.swf" style=" height:58px; width:155px;position:absolute;left:1023px; top:27px"></embed>
                    

                   <!--  <img src="http://s6.mogucdn.com/p2/160804/1rp_49cgihk50031c69jjk51ilkjk4950_210x157.gif" /> -->
                </a>
            </div>
        </div>

                <div class="nav_main_box">
                    
    <ul class="nav_main">
        <li class="all"><a href="<?php echo U('List/index');?>" style="color:white">全部商品</a>
            <div class="attr_box">
                <ul class="sec_attr" id="option">
                    <?php if(is_array($types)): foreach($types as $key=>$vo): ?><li class="list" id="<?php echo ($vo['id']); ?>">
                        <div class="list_cont" >
                            <h4  class="nav_tle">
                                <a href="<?php echo U('List/index',['tid'=>$vo['id']]);?>"><span style="text-align:center"><?php echo ($vo['name']); ?></span></a>
                            </h4>
                            <samp class="corner">
                                <img src="/Public/Home/p1/160810/idid_ifrtom3dmqygcojumezdambqhayde_6x10.png" />
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
        </li>
    </ul>

  
                    </div>
                </div>
    
    <div class="top_wrap">

        <div class="banner_box" id="banner">
            <div class="top_bnr">
            <ul class="banner">
            <?php if(is_array($momo)): foreach($momo as $key=>$v): ?><li>
                    <a class="pic imgBox" name="秋款新装" href="<?php echo U('List/index',['tid'=>$v['link']]);?>"  style="background: repeat center top;">
                      <span asrc="/Public/Uploads/<?php echo ($v['pic']); ?>" width="895px" height="477px"></span>
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
            
            <!-- <div style="margin-top:40px">            
                <img src="/Public/Home/01.jpg" width="1200px" height="285px">
            </div> -->
            
        <?php if(empty($cuxiaoID)): else: ?>
            <h1 style="color:black;font-size:29px;font-weight:800px;margin-top:70px" align="center">秒杀专区</h1>

            <ul class="top_ad_box">
                <?php if(is_array($cuxiaoData)): foreach($cuxiaoData as $key=>$vo): ?><li style="height:600px;width:280px;">             
                    <a href="<?php echo U('Goods/showwSalesDetailView',['id'=>$vo['id'],'saletime'=>$vo['saletime']]);?>">                 
                        <img src="/Public/Uploads/<?php echo ($vo['pic']); ?>" style="height:290px;width:280px;">                 
                        <h4 style="width:260px;height:40px;font-size:14px;text-align:center;margin-left:10px"><?php echo ($vo["name"]); ?></h4>                                               
                    </a>
                    <div align="center" style="border:1px solid red;padding:1px;height:30px">                                            
                       <i style="font-size:19px;line-height:30px">¥ <?php echo ($vo["price"]); ?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>                                     
                <a href="<?php echo U('Goods/showwSalesDetailView',['id'=>$vo['id'],'saletime'=> $vo['saletime'] ]);?>"  class="btn btn-danger radius qiang" style="background-color:#e01222;font-size:23px;float:right;color:white"  >立即抢购</a>
                    </div>       
                    </li><?php endforeach; endif; ?>
            </ul><?php endif; ?>
  <h2 alt="热销上衣" ><img src="/Public/Home/p2/160810/1sy_7kgkelaf2k0kh060dbh8d6cife273_150x71.jpg"></h2>
    <div class="common_box" id="clothes" class="yifu">
        <div class="ad_t">
            <a class="ad1 imgBox">
                <img src="/Public/Home/p2/160810/1sd_3fbhd1ia7e5ah485ia02g7e7gcg44_590x284.png" >
            </a>

            <a class="ad2imgBox" href="">
                <img src="/Public/Home/timg.gif" width="184px" height="224px"  style="margin-left:18px">
                <div style="width:184px;height:60px;font-size:12px;margin-left:18px;text-align:center"></div>
            </a>
            <a class="ad2imgBox" href="">
                <img src="/Public/Home/timg.gif" width="184px" height="224px" style="margin-left:18px">
                <div style="width:184px;height:60px;font-size:12px;margin-left:18px;text-align:center"></div>

            </a>
            <a class="ad2imgBox" href="">
                <img src="/Public/Home/timg.gif" width="184px" height="224px" style="margin-left:18px">
                <div style="width:184px;height:60px;font-size:12px;margin-left:18px;text-align:center"></div>

            </a>

        </div>
        <div class="ad_b">
            <div class="ad_attr_box">
                 <?php if(is_array($arr1)): foreach($arr1 as $key=>$vo): ?><a href="<?php echo U('List/index',['tid'=>$vo['id']]);?>" target="_blank" 
                    <?php if($vo['id']%2==0) echo "class='red'";?> ><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>
            </div>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160804/1sd_50g38el56kaf9c0j30a2cdd6gde3k_285x220.png"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160810/1sd_3i4hiikak3hll547fcj7c48c1b71b_285x220.png"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160810/1sd_51g7j8k7gh6kleh254gkjahcfd827_285x220.png"></span>
            </a>
        </div>
    </div>

    <h2 alt="时髦美裙"><img src="/Public/Home/p2/160810/1sy_5b6aikjb3cgdk9jj8j65h5dafh13i_150x71.jpg"></h2>
    <div class="common_box" id="dress" class="yifu">
        <div class="ad_t">
            <a class="ad1 imgBox">
                <span asrc="/Public/Home/p2/160810/1sy_086081299j6gkilaiaic0k1c73a6k_590x284.jpg"></span>
            </a>
            <a href="" class="ad2imgBox" target="_blank">
             <img src="/Public/Home/timg.gif" width="184px"  style="margin-left:18px" height="224px">
                <div style="width:184px;height:60px;font-size:12px;margin-left:18px;text-align:center"></div>
            </a>
            <a href="" class="ad2imgBox" target="_blank">
              <img src="/Public/Home/timg.gif" width="184px" style="margin-left:18px"  height="224px">
                <div style="width:184px;height:60px;font-size:12px;margin-left:18px;text-align:center"></div>
            </a>
            <a href="" class="ad2imgBox" target="_blank">
              <img src="/Public/Home/timg.gif" width="184px" style="margin-left:18px"  height="224px">
                <div style="width:184px;height:60px;font-size:12px;margin-left:18px;text-align:center"></div>
            </a>
        </div>
        <div class="ad_b">
            <div class="ad_attr_box">
                <?php if(is_array($arr2)): foreach($arr2 as $key=>$vo): ?><a href="<?php echo U('List/index',['tid'=>$vo['id']]);?>" target="_blank" 
                    <?php if($vo['id']%2==0) echo "class='red'";?> ><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>
            </div>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160804/1sy_0k11eeecc0aj2e99gak95d2fjec4c_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160804/1sy_7k4f7l86d7akj2ch6che3h885bhk0_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160804/1sy_648g2318gi9ga53l85lihekda88d0_285x220.jpg"></span>
            </a>
        </div>
    </div>

    <h2 alt="精选裤子"><img src="/Public/Home/p2/160810/1sy_6g3edk5k669kac3fbfd0ch589b895_150x71.jpg"></h2>
    <div class="common_box" id="pant" class="yifu">
        <div class="ad_t">
            <a class="ad1 imgBox">
              <span asrc="/Public/Home/p2/160817/upload_89k2gkhjejg2dkf9l6ae894374eb8_590x284.jpg"></span>
            </a>
            <a href="" class="ad2imgBox" target="_blank">
                <img src="/Public/Home/timg.gif" width="184px" height="224px" style="margin-left:18px">
                <div style="width:184px;height:60px;font-size:12px;;margin-left:18px;text-align:center"></div>
            </a>
            <a href="" class="ad2imgBox" target="_blank">
              <img src="/Public/Home/timg.gif" width="184px" height="224px" style="margin-left:18px">
                <div style="width:184px;height:60px;font-size:12px;;margin-left:18px;text-align:center"></div>
            </a>
            <a href="" class="ad2imgBox" target="_blank">
              <img src="/Public/Home/timg.gif" width="184px" height="224px" style="margin-left:18px">
                <div style="width:184px;height:60px;font-size:12px;;margin-left:18px;text-align:center"></div>
            </a>
        </div>
        <div class="ad_b">
            <div class="ad_attr_box">
                <?php if(is_array($arr3)): foreach($arr3 as $key=>$vo): ?><a href="<?php echo U('List/index',['tid'=>$vo['id']]);?>" target="_blank" 
                    <?php if($vo['id']%2==0) echo "class='red'";?> ><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>
            </div>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160804/1s3_2d2e0l2i5h6bja3c56eh6c1k21eeh_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160809/1s3_01gf2b05jkj3icec24hk6cl827kah_285x220.jpg"></span>
            </a>
            <a class="ad_3 imgBox">
              <span asrc="/Public/Home/p2/160809/1s3_2913k8dda5ha42407f3e911cg080d_285x220.jpg"></span>
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
                <h4>友情链接</h4>
                <?php  $linkdatas = M('link')->where('status=1')->limit(3)->select(); foreach($linkdatas as $v) { ?>
                <div>
                    <a href="<?php echo ($v['url']); ?>" target="_blank">
                    <span class="i-qzone"><img src="/Public/Uploads/<?php echo ($v['pic']); ?>" style="height:20px;width:20px;"></span><?php echo ($v['name']); ?></a>
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
                    <img class="qrcode" src="/Public/Home/p2/160802/7e_74j23d2a5f5j3bj31h70375gbeec1_100x100.png">
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
                        <img src="/Public/Home/p2/160802/7e_0h22fa0g03cgl0c5676cb6k2ii71h_140x140.png">
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

    
    <script type="text/javascript" src="/Public/Home/pc/jsmin/jquery.js"></script>

    <script type="text/javascript" src="/Public/Home/__static/logger/0.1.8/logger.js"></script>
    <script src="/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
    <script src="/Public/Home/pc/~page/welcome+base?1607170150.25"></script>
    <script>fml.use('page/welcome');;
        fml.use('base');;
        fml.iLoad();
    </script>

<script type="text/javascript">

        
var marke = 1;
setInterval(function() {

   
    if (marke > 0) {
    $('.qiang').css({"color":"white","background-color":"#e01222"});
       
    } else {
      
    $('.qiang').css({"color":"#e01222","background-color":"white"});
    }
    marke = -marke;


}, 400);


</script>

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
                    ulStr += "<a href='<?php echo U('List/index','','');?>/tid/"+msg.data[i].id+"'>"+ msg.data[i].name +'</a>';          
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


    var w = 300;
    bb(w);
    function bb(w)
    {
        var timer = setInterval(function() {
            w++;
            if (w >= 450) {
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
            if (w <= 300) {
                clearInterval(timer);
                 bb(w);
            } else {
              $('#viva').css({'top':w+'px'});

            }
        }, 8);

    }

    function toVip(obj,uid,role){
        // console.log(uid);
        // console.log(role);
        $.post(
            "<?php echo U('Index/beVip');?>",
            {uid: uid, role: role},
            function (msg) {
                if (msg.code == 1200) {
                   
                } else {                   
                
                }
            },
            'json'
        );
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


var flag = true;
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
                    var num = msg.data.length;
                    console.log(num);
                     for (var w = 0; w < num; w++) { 

                      $('h2').eq(i).next().find(".ad2imgBox").eq(w).find('img').attr('src','/Public/Uploads/'+msg.data[w].pic);
                      $('h2').eq(i).next().find(".ad2imgBox").eq(w).find('div').html(msg.data[w].name);
                      $('h2').eq(i).next().find(".ad2imgBox").eq(w).attr('href',"<?php echo U('Goods/showDetailView','','');?>/id/"+msg.data[w].id);
                    }
                    $('h2').eq(i).attr('boxes','true');

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
});
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