<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        <?php echo ($datas['title']); ?>
    </title>

    <meta name="description" content="<?php echo ($datas['desc']); ?>" />
    <meta name="keywords" content="<?php echo ($datas['keywords']); ?>" />
    <link rel="icon" href="/shop2/Public/Uploads/<?php echo ($datas['icon']); ?>" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171729.25" />
   
  
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/account/datepicker.css?1607171729.25" />

    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/fml.js?1"></script>    
   <script type="text/javascript" src="/shop2/Public/Home/js/jquery-1.12.3.min.js"></script>
    
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" /> 	
    <!-- <link rel="icon" href="/shop2/Public/Home/7_204_52.c5.png" type="image/x-icon" /> -->
			
 
    <link rel="icon" href="/shop2/Public/Home/pic/_o/75/6e/2f6871f198c0bd7615ffbf9a2f5f_49_48.c5.png" type="image/x-icon" />	
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/search/catalog.css?1607171726.25"/>
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/search/filter.css?1607171726.25"/>	
  
    
    <script type="text/html" id="posterWall"> 

    <div class="goodsWrap">  
        <div class="goodsContainer">       
            <a class="goodsImg" href="<?= data.link ?>" target="_blank" style="padding-bottom: <?= data.show.h / data.show.w * 100 ?>%;background:url('<?= data.show.img ?>') no-repeat center center;">            <!-- <img src="<?= data.show.img ?>" > -->      
            </a>            
            <? if(data.lefttop_taglist.length >0){ ?>               
                <div class="brandIcon">           
                    <img src="<?= data.lefttop_taglist[0].img ?>">          
                </div>     
            <?}?>    
        </div>     
        <div class="priceWrap">         
            <div class="price">￥<?= data.price ?></div>         
            <div class="shoucang"><span class="shoucangIcon"></span>        
                <? if(data.cfav==null){ ?>              0       
                    <?}else{?>         
                         <?= data.cfav ?>        
                <?}?>       
            </div>  
        </div>  
        <a class="goodsTitle" href="<?= data.link ?>"><?= data.title ?></a> 
    </div>
    </script>
    </div>

    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js?1.12.4" ></script>
    <script type="text/javascript" src="/shop2/Public/Home/__static/logger/0.1.8/logger.js"></script>
                 <!--   <script type="text/javascript" src="/shop2/Public/Home/js/jquery-1.12.3.min.js"></script> -->
    <script src="/shop2/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
    <script src="/shop2/Public/Home/pc/~page/search/catalog+base?1607171726.25"></script>

    <script type="text/javascript" src="/shop2/Public/js/jquery.lazyload.min.js"></script>
    <script type="text/javascript">
        $('#biaoqian').mouseover(function() {
            // alert(222);
            $('#biaoqian').css("border","1px solid blue");
        })

        $('#biaoqian').mouseout(function() {
            $('#biaoqian').css("border","1px solid rgb(221, 221, 221)");
        })
   
        $(function() { 
            $(".lazy").lazyload({ 
                placeholder:"/shop2/Public/Home/timg.gif",
                effect : "fadeIn" ,
                threshold:200,
                failurelimit:10

            }); 
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
    
    <div class="wrap">    
        <!-- 推荐 -->        
        <div class="userContain" data-link="/search/catalog/10057049">  
            <div class="choice">        
                <a href="<?php echo U('List/index');?>">所有分类 >&nbsp;</a>             
                <div class="userchoiceWrap">   

                <?php if(is_array($fenlei)): foreach($fenlei as $key=>$v): ?><a href="<?php echo U('List/index', ['id'=>$v['id'],'bqname'=>$v['name']]);?>">
                    <p class="userchoice" id="biaoqian"  data-catepropnameid="2056" style="border: 1px solid rgb(221, 221, 221);" >
                    <span><?php echo ($v['name']); ?></span>
                    <span class="close del" data-catepropnameid="2056"></span>
                    </p >
                    </a><?php endforeach; endif; ?>

                </div>       
                找到<?php echo ($total); ?>件相关结果
            </div> 

     

          

            <!-- 分类 -->    
            <div class="styleWrap">  

                <div class="styleInfo"> 
                <?php if(empty($typedatas)): else: ?>
                    <div class="styleCatalog">              
                        <div class="styleContainer">                                        
                            <p class="styleTitle" data-catePropNameId="2048">分类：</p>                                       
                            <p class="styleNameWrap">  
                                <?php if(is_array($typedatas)): foreach($typedatas as $key=>$vo): ?><a href="<?php echo U('List/index', ['tid'=>$vo['id'],'bid'=>$bid,'color'=>$color,'keyword'=>$keyword]);?>"  class="styleName" data-isClick='0' data-catePropId="10000"><span class="choiceBox"></span><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>                                             
                                                                         
                            </p>  
                            <a class="more">                        
                                <span class="moreDesc">更多</span>
                                <span class="moreArrow"></span>                 
                            </a>                                                                
                        </div>                              
                    </div><?php endif; ?> 

                <?php if(empty($brandShow)): else: ?>
                    <div class="styleCatalog"   style="padding:2px 0">              
                        <div class="styleContainer" style="padding:2px 0">                                        
                             <span class="styleTitle" data-catePropNameId="2050">品牌：</span> 
                                                                  
                             <span class="styleNameWrap" >                                               
                                <?php if(is_array($brandShow)): foreach($brandShow as $key=>$vo): ?><a href="<?php echo U('List/index', ['bid'=>$vo['id'],'tid'=>$id,'color'=>$color,'keyword'=>$keyword]);?>"  class="styleName"  ><img src="/shop2/Public/Uploads/<?php echo ($vo['logo']); ?>" title="<?php echo ($vo['name']); ?>" width="76px"  height="37px" ></a><?php endforeach; endif; ?>            
                            </span>                                                                 
                        </div>                 
                    </div><?php endif; ?>     

                <?php if(empty($colors)): else: ?>
                  <div class="styleCatalog">              
                        <div class="styleContainer">                                        
                            <p class="styleTitle" data-catePropNameId="2060">颜色：</p>                                        
                            <p class="styleNameWrap" data-choice=''>  
                         <?php if(is_array($colors)): foreach($colors as $key=>$vo): ?><a href="<?php echo U('List/index', ['bid'=>$bid,'tid'=>$id,'color'=>$vo['color'],'keyword'=>$keyword]);?>" class="styleName" data-isClick='0' ><span class="choiceBox"></span><?php echo ($vo['color']); ?></a><?php endforeach; endif; ?>                                                
                            </p>                    
                                                          
                        </div>                    
                    </div><?php endif; ?> 

                </div> 
            </div>      
        </div>              
        <!-- 排序 --> 
        <div class="orderWrap">    
                    <!-- 流行 热销 上新 价格 -->        
            <div class="orderInfo" data-checkedSort="pop">               
                <a href="<?php echo U('index',['order' => 'buynum desc','tid' => $id , 'bid'=>$bid ,'keyword'=>$keyword, 'num1'=>$num1,'num2'=>$num2]);?>"  class="fashion both " data-sort="sell">热销</a>                          
                <!-- <a href="<?php echo U('list',['order' => 'price','id' => $id]);?>" class="fashion">  <span>价格</span>&#x25b2;</a>      -->
                <!-- <a href="<?php echo U('list',['order' => 'price desc','id' => $id]);?>" class="fashion both"  ><span>价格&#x25bc;</span></a>   -->
                  <div class="fashion price left ">   
                 <span class="priceCon">价格</span>  

                 <span class="priceArrow"></span>              
                    <ul class="priceDesc">                  
                        <li class="down" data-sort="price_desc"><a href="<?php echo U('index',['order' => 'price desc','tid' => $id , 'bid'=>$bid ,'keyword'=>$keyword, 'num1'=>$num1,'num2'=>$num2]);?>">价格从高到低</a></li>                  
                        <li class="up"  data-sort="price_asc"><a href="<?php echo U('index',['order' => 'price','tid' => $id , 'bid'=>$bid ,'keyword'=>$keyword, 'num1'=>$num1,'num2'=>$num2]);?>">价格从低到高</a></li>                
                    </ul>          
                 </div>   
            </div> 

                    <!-- 价格部分 -->       
            <div class="priceWrap"> 
                <form action="<?php echo U('List/index');?>">     
                <input class="minPrice" type="text" placeholder="￥" name="num1" value="<?php echo ($num1); ?>"> 
                <input type="hidden" name="color" value="<?php echo ($color); ?>">              
                <input type="hidden" name="bid" value="<?php echo ($bid); ?>">            
                <input type="hidden" name="tid" value="<?php echo ($id); ?>">              
                <span>~</span>              
                <input class="maxPrice" type="text" placeholder="￥" name="num2" value="<?php echo ($num2); ?>">          
                  
                <button class="sure">确认</button> 
                </form>        
            </div>            
        </div> 
        <div class="product">
            <?php if(empty($list)): ?><div height="400px" style="line-height:400px;font-size:18px;text-align:center">抱歉，没搜索到与"<?php echo ($keyword); ?>"有关的商品</div>
            <?php else: ?>       
            <ul class="clearfix product-ul" id="product-ul"> 

            <?php if(is_array($list)): foreach($list as $key=>$v): ?><li class="product-list fl">                
                    <div class="img-size">                                          
                        <a class="img-link" class="lazy" target="_blank" href="<?php echo U('Goods/showDetailView',['id' => $v['id']]);?>" style="background:url(/shop2/Public/Uploads/<?php echo ($v['pic']); ?>) no-repeat center center;background-size:cover;"></a>                                    
                    </div>             
                    <div class="product-info clearfix">            
                        <div class="price fl"><em class="price-u">¥</em><span class="price-n"><?php echo ($v['price']); ?></span>
                        </div>               
                        <div class="fav fr">
                            <em class="fav-i"></em>                                                                    
                        </div>             
                    </div>              
                    <div>
                        
                    </div>                                 
                                  
                    <a class="text-link" href="<?php echo U('Goods/showDetailView',['id' => $v['id']]);?>"><?php echo ($v['name']); ?> 
                    <!-- 【<?php echo ($v['brandname']); ?>】<?php echo ($v['name']); ?> -->
                    </a>              
                </li><?php endforeach; endif; ?> 


             </ul><?php endif; ?>   
        </div>  
        <!-- 登录用户显示搜索结果数目 -->  

    </div>
        <!-- <div id="pagination" class="pagination"></div> -->
        <!--翻页-->
    <div class="pageNav">  
                                
       <?php echo ($page_show); ?>
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

    
    <script type="text/html" id="posterWall"> 

    <div class="goodsWrap">  
        <div class="goodsContainer">       
            <a class="goodsImg" href="<?= data.link ?>" target="_blank" style="padding-bottom: <?= data.show.h / data.show.w * 100 ?>%;background:url('<?= data.show.img ?>') no-repeat center center;">            <!-- <img src="<?= data.show.img ?>" > -->      
            </a>            
            <? if(data.lefttop_taglist.length >0){ ?>               
                <div class="brandIcon">           
                    <img src="<?= data.lefttop_taglist[0].img ?>">          
                </div>     
            <?}?>    
        </div>     
        <div class="priceWrap">         
            <div class="price">￥<?= data.price ?></div>         
            <div class="shoucang"><span class="shoucangIcon"></span>        
                <? if(data.cfav==null){ ?>              0       
                    <?}else{?>         
                         <?= data.cfav ?>        
                <?}?>       
            </div>  
        </div>  
        <a class="goodsTitle" href="<?= data.link ?>"><?= data.title ?></a> 
    </div>
    </script>
    </div>

    <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js?1.12.4" ></script>
    <script type="text/javascript" src="/shop2/Public/Home/__static/logger/0.1.8/logger.js"></script>
                 <!--   <script type="text/javascript" src="/shop2/Public/Home/js/jquery-1.12.3.min.js"></script> -->
    <script src="/shop2/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
    <script src="/shop2/Public/Home/pc/~page/search/catalog+base?1607171726.25"></script>

    <script type="text/javascript" src="/shop2/Public/js/jquery.lazyload.min.js"></script>
    <script type="text/javascript">
        $('#biaoqian').mouseover(function() {
            // alert(222);
            $('#biaoqian').css("border","1px solid blue");
        })

        $('#biaoqian').mouseout(function() {
            $('#biaoqian').css("border","1px solid rgb(221, 221, 221)");
        })
   
        $(function() { 
            $(".lazy").lazyload({ 
                placeholder:"/shop2/Public/Home/timg.gif",
                effect : "fadeIn" ,
                threshold:200,
                failurelimit:10

            }); 
        }); 


    </script>
         
 
</body>
</html>