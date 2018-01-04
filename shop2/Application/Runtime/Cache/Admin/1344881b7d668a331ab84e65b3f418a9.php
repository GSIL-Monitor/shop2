<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" /> 
        <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/shop2/Public/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
        <link href="/shop2/Public/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />   
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>   
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
        <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
        <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>
<title>产品列表</title>
</head>
<body>
<div class=" page-content clearfix">
 <div id="products_style">
    <form action="" method="post">
    <div class="search_style">
      <div class="title_names">搜索查询</div>
      <ul class="search_content clearfix">
       <li><label class="l_f">产品名称</label><input name="search" type="text" value="<?php echo ($goodsname); ?>" class="text_add" placeholder="输入品牌名称"  style=" width:250px"/></li>
       <li><label class="l_f">选择品牌</label><select class="input-text"  placeholder="" id="shop_brand" name="shop_brand">
       
              <option value="">--请选择品牌--</option>
              <?php if(is_array($brand)): foreach($brand as $key=>$ov): ?><option value="<?php echo ($ov["id"]); ?>" <?php if($vo['id']==7){echo "selected";}?>  /><?php echo ($ov["name"]); ?></option><?php endforeach; endif; ?>
              </select></li>
       <li style="width:90px;"><button class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
    </div>
    </form>
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('Goods/addgoods');?>" title="添加商品" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加商品</a>
        <a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
       <span class="r_f">共：<b><?php echo ($count); ?></b>件商品</span>
     </div>
     <!--产品列表展示-->
       <div id="scrollsidebar" class="left_Treeview">
         <div class="widget-body">
          
       </div>
      </div>
         <div class="table_menu_list" id="testIframe">
         <?php echo ($pageBtn); ?>
       <table class="table table-striped table-bordered table-hover" id="sample-table">
        	<thead>
        	 <tr>
        			<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
        			<th width="80px">产品编号</th>
        			<th width="250px">产品名称</th>
        			<th width="80px">原价格</th>
        			<th width="180px">加入时间</th>
              <th width="80px">购买量</th>
              <th width="80px">点击量</th>
         
              <th width="80px">添加属性</th>
        			<th width="70px">状态</th>
        			<th width="200px">操作</th>
        		</tr>
        	</thead>
            <tbody>
                <?php if(is_array($data)): foreach($data as $key=>$ov): ?><tr class="1">
                    <td width="25px"><label><input type="checkbox" class="ace" checkid="<?php echo ($ov["id"]); ?>"><span class="lbl"></span></label></td>
                    <td width="80px"><?php echo ($ov["id"]); ?></td>
                    <td width="250px"><?php echo ($ov["name"]); ?></td>
                    <td width="80px"><?php echo ($ov["price"]); ?></td>        
                    <td width="180px"><?php echo ($ov["addtime"]); ?></td>
                    <th width="80px" style="text-align:center;"><?php echo ($ov["buynum"]); ?></th>
                    <th width="80px" style="text-align:center;"><?php echo ($ov["clicknum"]); ?></th>
                 
                    <td class="text-l">
                        <a href="<?php echo U('Goods/attr',[id=>$ov['id']]);?>" id="goods_add" title="添加属性" class="btn btn-primary" style="width:42.41px; line-height:16px;"><i class="icon-plus"></i></a>
                    </td>

                    <td class="td-status">

                    <?php if(($ov['status'] == 1)): ?><span class="label label-success radius">新添加</span>
                      <?php elseif(($ov['status'] == 2)): ?>
                        <span class="label label-defaunt radius">在售中</span>
                      <?php elseif(($ov['status'] == 3)): ?>
                        <span class="label label-warning radius">已下架</span>
                      <?php elseif(($ov['status'] == 4)): ?>
                        <span class="label label-warning radius">促销中</span><?php endif; ?>

                    </td>

                    <td class="td-manage">

                      <!--   <a href="<?php echo U('Goods/showTest',[id=>$ov['id'],status=>$ov['status']]);?>" title="设置状态"  class="btn btn-xs btn-success">状态</a>
                      </if> -->
                      <a title="编辑"  href="<?php echo U('Goods/editgoods',[id=>$ov['id']]);?>"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
                      <a title="删除" href="javascript:;"  onclick="member_del(this,<?php echo ($ov["id"]); ?>)" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
                    </td>
                  </tr><?php endforeach; endif; ?>
                
            </tbody>
        </table>
    </div>     
  </div>
 </div>
</div>
  <div class="add_menber" id="add_menber_style" style="display:none">
    <ul class=" page-content">
       <li><label class="label_name">积&nbsp;&nbsp; &nbsp;分：</label><span class="add_name"><input value="" name="积分" type="text"  class="text_add"/></span></li>
      </ul>
  </div>
 </div>
</body>
</html>
<script>

/**
 * 修改产品积分
 */
/*function changeStatus(id,sorce){
  layer.open({
        type: 1,
        title: '修改积分',
        maxmin: true, 
        shadeClose:false, //点击遮罩关闭层
        area : ['500px' , '200px'],
        content:$('#add_menber_style'),
    btn:['提交','取消'],
    yes:function(index,layero){
       var num=0;
       $(".add_menber input[type$='text']").val(sorce);
        $(".add_menber input[type$='text']").each(function(n){
          if($(this).val()=="")
          {
               
          layer.alert($(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',       
          icon:0,      
          }); 
        num++;
            return false;
          } 
     });
      if(num>0){  return false;}    
          else{
        layer.alert('添加成功！',{
               title: '提示框',        
      icon:1,
        });
         layer.close(index);  
      }                     
    }
    });
}*/
//member_stop(this,<?php echo ($ov["id"]); ?>,<?php echo ($ov["status"]); ?>)
/*产品-停用*/
function member_stop(obj,id,status){

  console.log('停用');
	layer.confirm('确认要停用吗？',function(index){

    $.ajax({
      url:"<?php echo U('Goods/updateStatus');?>",
      type:"get",
      data:"id="+id+"&status=1",
      success:function (msg){
        console.log(msg);
        if (msg['code'] == 1200) {
          console.log('进来');
          $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,'+id+','+status+')" href="javascript:;" title="启用"><i class="icon-ok bigger-120"></i></a>');
          $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
          $(obj).remove();
          layer.msg('已停用!',{icon: 5,time:1000});
          console.log(id);
        }
      },
      dataType:'json'
    });
		
	});
}

/*产品-启用*/
function member_start(obj,id,status){

  console.log('启用');
	layer.confirm('确认要启用吗？',function(index){
    console.log('启用了');
     $.ajax({
      url:"<?php echo U('Goods/updateStatus');?>",
      type:"get",
      data:"id="+id+"&status=2",
      success:function(msg){
        console.log(msg);
        if (msg['code'] == 1200) {
          $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,'+id+','+status+')" href="javascript:;" title="停用"><i class="icon-ok bigger-120"></i></a>');
          $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
          $(obj).remove();
          layer.msg('已启用!',{icon: 6,time:1000});
        }
      },
      error:function(msg){
        console.log('??');
      },
      dataType:'json'
    });
		

	});
}
/*产品-编辑*/
function member_edit(obj,id){
	// layer_show(this.id);
}

/*产品-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){

    $.ajax({
      url:"<?php echo U('Goods/deleteGoodsData');?>",
      type:'get',
      data:'id='+id,
      success:function(msg){
        console.log(msg);
        if (msg['code'] == 1200) {
          $(obj).parents("tr").remove();
          layer.msg('已删除!',{icon:1,time:1000});
        }else{
          layer.msg('删除失败,请重试',{icon:1,time:1000});
        }
      },
      dataType:'json'
    });	
	});
}
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form').on('click', function(){
	var cname = $(this).attr("title");
	var chref = $(this).attr("href");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe').html(cname);
    parent.$('#iframe').attr("src",chref).ready();;
	parent.$('#parentIframe').css("display","inline-block");
	parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
    parent.layer.close(index);
	
});


$(document).click(function () {
    // location.reload();
})


// $('select').change(function () {
//     console.log($("select").val());
// })


/*添加管理员*/
/*$('#goods_add').on('click', function(){
  layer.open({
    type: 1,
  title:'添加属性',
  area: ['700px',''],
  shadeClose: false,
  content: $('#add_administrator_style'),
  
  });
})*/

$('#size_type').change(function () {

    var size = parseInt($('#size_type').val());
    if (size == 0) {

        $('#innerOuter').css('visibility', 'visible');
    }
}).blur(function () {

    $('#innerOuter').css('visibility', 'hidden');
})

$('#color_type').change(function () {

    var color = parseInt($('#color_type').val());
    if (color == 0) {

        $('#inner').css('visibility', 'visible');
    }
}).blur(function () {

    $('#inner').css('visibility', 'hidden');
})

$('input[name="number"]').focus(function () {

    $('#outer').css('visibility', 'hidden');
    $(this).after('<b id="afterVisible" style="font-size:12px; color:orange;">1-7位</b>');
}).blur(function () {

    $('#afterVisible').remove();

    var number = parseInt($('input[name="number"]').val());
    if (number == NaN || number == 0) {

        $('#outer').css('visibility', 'visible');
    }
})


$("form").submit( function () {
      
    var number = parseInt($('input[name="number"]').val());
    var size = parseInt($('#size_type').val());
    var color = parseInt($('#color_type').val());

    $.ajax({
        url: "<?php echo U('Brand/tesst');?>",
        type: "post",
        data: "number="+number+"&size"+size+"&color="+color,
        success: function (msg) {

            console.log(msg);
        },
        dataType: "json"
    });
});

</script>