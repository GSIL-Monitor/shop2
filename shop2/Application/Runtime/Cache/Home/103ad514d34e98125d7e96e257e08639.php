<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" /><title>上衣_美丽说</title><meta name="description" content="美丽说，专注时尚新款发布。海量新款每日上新，每周五新款大促火热进行中！旗下海淘品牌“HIGO”挑选全球时尚好货，满足你全方位的时尚购物体验！" /> 
    <meta name="keywords" content="美丽说,higo,衣服,鞋子,包包,配饰,家居,美妆,搭配,团购,美丽说higo" />
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" /> 	
    <!-- <link rel="icon" href="/shop2/Public/Home/7_204_52.c5.png" type="image/x-icon" /> -->
			
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/base.css?1607171726.25" />	 
    <link rel="icon" href="/shop2/Public/Home/pic/_o/75/6e/2f6871f198c0bd7615ffbf9a2f5f_49_48.c5.png" type="image/x-icon" />	
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/search/catalog.css?1607171726.25"/>
    <link rel="stylesheet" type="text/css" href="/shop2/Public/Home/pc/css/page/search/filter.css?1607171726.25"/>	
</head>
<body>
    <div class="head">           
        <div id="com-topbar">
            <div class="inner"> 
                <ul>  
                     <li class="drop" style="float:left">
                        <a href="<?php echo U('Index/index');?>" >
                          <em class="home"></em>美丽说首页
                          </a>
                     
                    </li>

                    <li class="drop">                   
                        <a href="setPersonal.html" class="nick" target="_blank">                        
                            <img class="face" src="/shop2/Public/Home/new1/v1/bdefaultavatar/03.jpg" />阿猫来了<em class="arrow"></em> 
                        </a>                    
                        <ul class="down account">                      
                            <li><a href="javascript:;" target="_blank">账号与安全</a></li>                       
                            <li><a href="#">退出</a></li>                 
                        </ul>              
                    </li>  
                    <li class="drop">                
                        <a href="mylike.html" target="_blank"><em class="collect"></em>我的收藏</a> 
                        <ul class="down"> <li><a href="mylike.html" target="_blank">收藏宝贝</a></li> 
                            <li><a href="mylikestore.html" target="_blank">收藏店铺</a></li> 
                        </ul>            
                    </li> 
                    <li class="drop cart-wrapper">          
                        <a target="_blank" href="mycart.html" class="my-cart"> <em class="cart"></em>我的购物车 </a> 
                        <div class="hidden"> <ul class="cart-goods"></ul> <p class="cart-account"> <span>购物车里还有<a class="num" href="mycart.html" target="_blank"></a>件商品</span> <a class="check-cart" href="mycart.html" target="_blank">查看购物车</a> </p> </div>          
                    </li>           
                    <li>                
                            <a href="orderlist.html" target="_blank"><em class="order"></em>我的订单</a>            
                    </li> 
                  
                </ul> 
            </div>
        </div>                                    
        <div id="com-search">   
            <div class="inner">     
                <a href="<?php echo U('Index/index');?>" class="logo"><img src="http://d02.res.meilishuo.net/pic/_o/50/a7/735e2614e3911e621f0446e54597_204_52.c5.png" alt=""></a>        
                <a href="" class="sublogo"></a>        
                <div class="search">            
                    <div class="search-tab">                
                        <span class="active">宝贝</span><span>店铺</span>           
                    </div>          
                    <div class="search-box">                
                        <input type="text" class="search-txt" >             
                        <span class="search-btn"></span>                
                        <div class="suggest-box"></div>         
                    </div>          
                    <div class="hotword">           
                    </div>      
                </div>      
                <a class="spread" href="" target="_blank">
                <embed src="/shop2/Public/Home/img/honehone_clock_wh.swf" style=" height:58px; width:155px;position:absolute;left:1023px; top:27px"></embed>
            </a> 
            </div>
        </div>                
        <div class="sec_nav">  
            
        </div>     
    </div>


    <div class="wrap">    
        <!-- 推荐 -->        
        <div class="userContain" data-link="/search/catalog/10057049">  
            <div class="choice">        
                <a href="/search/catalog/10057049?action=clothing">所有分类 >&nbsp;</a>             
                <div class="userchoiceWrap">   

                <?php if(is_array($fenlei)): foreach($fenlei as $key=>$v): ?><a href="<?php echo U('List/list', ['id'=>$v['id'],'bqname'=>$v['name']]);?>">
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
                                <?php if(is_array($typedatas)): foreach($typedatas as $key=>$vo): ?><a href="<?php echo U('List/list', ['tid'=>$vo['id'],'bid'=>$bid,'color'=>$color]);?>"  class="styleName" data-isClick='0' data-catePropId="10000"><span class="choiceBox"></span><?php echo ($vo['name']); ?></a><?php endforeach; endif; ?>                                             
                                                                         
                            </p>                                                                 
                        </div>                              
                    </div><?php endif; ?> 

                <?php if(empty($brandShow)): else: ?>
                    <div class="styleCatalog"   style="padding:2px 0">              
                        <div class="styleContainer" style="padding:2px 0">                                        
                             <span class="styleTitle" data-catePropNameId="2050">品牌：</span> 
                                                                  
                             <span class="styleNameWrap" >                                               
                                <?php if(is_array($brandShow)): foreach($brandShow as $key=>$vo): ?><a href="<?php echo U('List/list', ['bid'=>$vo['id'],'tid'=>$id,'color'=>$color]);?>"  class="styleName"  ><img src="/shop2/Public/Uploads/<?php echo ($vo['logo']); ?>" title="<?php echo ($vo['name']); ?>" width="76px"  height="37px" ><?php echo ($vo['title']); ?></a><?php endforeach; endif; ?>            
                            </span>                                                                 
                        </div>                 
                    </div><?php endif; ?>     

                <?php if(empty($color)): else: ?>
                  <div class="styleCatalog">              
                        <div class="styleContainer">                                        
                            <p class="styleTitle" data-catePropNameId="2060">颜色：</p>                                        
                            <p class="styleNameWrap" data-choice=''>  
                         <?php if(is_array($colors)): foreach($colors as $key=>$vo): ?><a href="<?php echo U('List/list', ['bid'=>$bid,'tid'=>$id,'color'=>$vo['color'] ]);?>" class="styleName" data-isClick='0' ><span class="choiceBox"></span><?php echo ($vo['color']); ?></a><?php endforeach; endif; ?>                                                
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
                <a href="<?php echo U('list',['order' => 'buynum desc','tid' => $id , 'bid'=>$bid]);?>"  class="fashion both " data-sort="sell">热销</a>                          
                <!-- <a href="<?php echo U('list',['order' => 'price','id' => $id]);?>" class="fashion">  <span>价格</span>&#x25b2;</a>      -->
                <!-- <a href="<?php echo U('list',['order' => 'price desc','id' => $id]);?>" class="fashion both"  ><span>价格&#x25bc;</span></a>   -->
                  <div class="fashion price left ">   
                 <span class="priceCon">价格</span>  

                 <span class="priceArrow"></span>              
                    <ul class="priceDesc">                  
                        <li class="down" data-sort="price_desc"><a href="<?php echo U('list',['order' => 'price desc','tid' => $id , 'bid'=>$bid]);?>">价格从高到低</a></li>                  
                        <li class="up"  data-sort="price_asc"><a href="<?php echo U('list',['order' => 'price','tid' => $id , 'bid'=>$bid]);?>">价格从低到高</a></li>                
                    </ul>          
                 </div>   
            </div> 

                    <!-- 价格部分 -->       
            <div class="priceWrap"> 
                <form action="<?php echo U('List/list');?>">     
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
            <ul class="clearfix product-ul" id="product-ul">  
            <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><li class="product-list fl">                
                    <div class="img-size">                                          
                        <a class="img-link" target="_blank" href="<?php echo U('Goods/showDetailView',['id' => $v['id']]);?>" style="background:url(/shop2/Public/Uploads/<?php echo ($v['pic']); ?>) no-repeat center center;background-size:cover;"></a>                                    
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


             </ul>   
        </div>  
        <!-- 登录用户显示搜索结果数目 -->  

    </div>
        <!-- <div id="pagination" class="pagination"></div> -->
        <!--翻页-->
    <div class="pageNav">  
                                
        <a class="pagePrev " style="display:none !important" href="?acm=1.mce.2.12299.0.0.15223_120219&mt=12.12299.r120219.15223&action=clothing&page=1&cpc_offset=20">&lt;上一页</a>    
        <a  class="currentpage"  href="?acm=1.mce.2.12299.0.0.15223_120219&mt=12.12299.r120219.15223&action=clothing&page=1&cpc_offset=20">1</a>   
                                
        <a  href="?acm=1.mce.2.12299.0.0.15223_120219&mt=12.12299.r120219.15223&action=clothing&page=2&cpc_offset=20">2</a>     
                                
        <a  href="?acm=1.mce.2.12299.0.0.15223_120219&mt=12.12299.r120219.15223&action=clothing&page=3&cpc_offset=20">3</a>     
                              
        <i>...</i>  
        <a href="?acm=1.mce.2.12299.0.0.15223_120219&mt=12.12299.r120219.15223&action=clothing&page=100&cpc_offset=20">100</a>       
        <a class="pageNext" style="" href="?acm=1.mce.2.12299.0.0.15223_120219&mt=12.12299.r120219.15223&action=clothing&page=2&cpc_offset=20">下一页&gt;</a>
    </div>
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
                <div>
                    <a href="aboutus.html" target="_blank">关于美丽说</a></div>         
                    <div><a href="contactus.html" target="_blank">联系我们</a></div>        
                </div> 



                <div class="flist aboutus">         
                    <h4>关注我们</h4>           
                    <div>               
                        <a href="#" target="_blank">                    
                            <span class="i-sina"></span>新浪微博                    
                            <div class="follow">                        一键关注新浪微博                        
                                <wb:follow-button uid="1718455577" type="red_1" width="67" height="24" ></wb:follow-button>                 
                            </div>              
                        </a>            
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
                    <img class="qrcode" src="/shop2/Public/Home/p2/160802/7e_61hjl8kjfjfagkg3cdaj05fghck9c_100x100.png" alt="美丽说服务号二维码"/>      
                </div>      
            <div class="flist last" style="float:left;">            
                <h4>美丽说客户端下载</h4>          
                <p style="background:none; margin-top:0px;" class="client">             
                    <img class="qrcode" src="/shop2/Public/Home/p2/160802/7e_74j23d2a5f5j3bj31h70375gbeec1_100x100.png">          
                </p>        
            </div>      
            <div class="record">            Copyright ©2016 Meilishuo.com &nbsp;
                <a href="/shop2/Public/Home/new1/v1/bmisc/518ea1bbd36948b90e658485d2700e62/181714310539.pdf" target="_blank">电信与信息服务业务经营许可证100798号</a>&nbsp;<a href="p1/160811/idid_ifrtszjqmmzdazrumezdambqhayde_2436x3500.jpg" target="_blank">经营性网站备案信息</a>&nbsp; <br /> 京ICP备11031139号&nbsp; 京公网安备110108006045&nbsp;&nbsp; 客服电话：4000-800-577&nbsp; 文明办网文明上网举报电话：010-82615762 &nbsp;<a href="http://net.china.com.cn/index.htm" target="_blank">违法不良信息举报中心</a>      
            </div>  
        </div>
    </div>
            <p style="display: none" class="biu-login">11cnkktq</p>
            <div class="biu-sidebar"> 
            <div class="biu-options"> 
            <div class="biu-download"> 下载<span>APP</span> 
            <div class="mls-qrcode"> 
            <img src="/shop2/Public/Home/p2/160802/7e_0h22fa0g03cgl0c5676cb6k2ii71h_140x140.png"> 
            </div> 
            </div>  
            <div class="biu-cart"> 
            <a href="mycart.html" target="_blank"><span class="cart-num biu-cart-num"></span>购物车</a> </div> <div class="biu-service"> <a class="biu-open-im"><span class="service-num biu-service-num"></span>消息</a> </div> <div class="biu-coupon"> <a href="coupon.html#" target="_blank"><span class="coupon-num biu-coupon-num"></span>优惠券</a> </div> 
            <div class="biu-mark"> 
            <a href="mylike.html" target="_blank">收藏</a> </div> <div class="biu-footprint"> <a href="footprint.html" target="_blank">足迹</a> </div>  </div> 
            <div class="biu-go2top"> 
            </div>
            </div>
            <script type="text/javascript" src="/shop2/Public/Home/pc/jsmin/jquery.js?1.12.4" ></script>
            <script type="text/javascript" src="/shop2/Public/Home/__static/logger/0.1.8/logger.js"></script>
   <!--   <script type="text/javascript" src="/shop2/Public/Home/js/jquery-1.12.3.min.js"></script> -->
            <script src="/shop2/Public/Home/__newtown/im_web/assets/common/openim/index.js"></script>
            <script src="/shop2/Public/Home/pc/~page/search/catalog+base?1607171726.25"></script>
            <script type="text/javascript">
                $('#biaoqian').mouseover(function() {
                    // alert(222);
                    $('#biaoqian').css("border","1px solid red");
                })

                $('#biaoqian').mouseout(function() {
                    $('#biaoqian').css("border","1px solid rgb(221, 221, 221)");
                })

            </script>
         
        
</body>

</html>