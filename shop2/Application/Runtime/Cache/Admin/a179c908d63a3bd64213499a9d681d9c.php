<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
         <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/shop2/Public/assets/css/colorbox.css"> 
         <!--图片相册-->   
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
      
        <link rel="stylesheet" href="/shop2/Public/font/css/font-awesome.min.css" />        
        <!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->
        
        <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>  
        <script src="/shop2/Public/assets/js/jquery.colorbox-min.js"></script>
        <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>           
        <script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
        <script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>  
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/handlers.js"></script>
     
        
<title>列表</title>
</head>

<body>
<div class="page-content clearfix">
 <div class="sort_adsadd_style">
  <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('Goods/addAttr',[id=>$gid]);?>" id="ads_add" title="添加属性" class="btn btn-warning Order_form"><i class="fa fa-plus"></i>添加属性</a>
        <a href="javascript:ovid()" onClick="javascript :history.back();" class="btn btn-info"><i class="fa fa-reply"></i> 返回上一步</a>
       </span>
       <span class="r_f">共：<b>234</b>个品牌</span>
     </div>
 <!--列表样式-->
    <div class="sort_Ads_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
        <thead>
         <tr>  
                <th width="80px">ID</th>
                <th width="100">颜色</th>
                <th width="80px">尺寸</th>
                <th width="150px">库存</th>
                <th width="180">编辑</th>
                <th width="70">状态</th>
                <th width="250">操作</th>
            </tr>
        </thead>
    <tbody>
    
       <?php foreach ($info as $ov) { ?>
    
      <tr>
       <td><?=$ov['id']?></td>
       <td><?=$ov['color']?></td>
       <td>
            
            <table>
               <?php
 $data = M('goods_size')->where('cid='.$ov['id']) ->getField('id,size,num'); foreach ($data as $value) { ?>
                <tr><td><span class="label"><?=$value['size']?></span></td></tr>
                <?php } ?>
            </table>

       </td>
       <td>
            <table>
                <?php foreach ($data as $value) { ?>
                <tr><td><span class="label"><?=$value['num']?></span></td></tr>
                <?php } ?>
            </table>
        </td>
        <td class="td-status">
            <table> 
                <?php foreach ($data as $value) { ?>
                <tr><td><span class="label" id="<?=$value['id']?>"><a href="<?php echo U('Goods/editsize',[id=>$value['id']]);?>">编辑</a></span></td></tr>
                <?php } ?>
            </table>
        </td>
        <td class="td-status"><span class="label label-success radius">显示</span></td>
        <td class="td-manage">
        <a onClick="member_stop(this,'10001')"  href="javascript:;" title="停用" class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>
        <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')"href="javascript:;" class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
        <a title="删除" href="javascript:;"  onclick="member_del(this,<?=$ov['id']?>)" class="btn btn-xs btn-warning" ><i class="fa fa-trash bigger-120"></i></a>
       </td>
      </tr>
        <?php } ?>
    </tbody>
    </table>
     </div>
 
 </div>
</div>
</body>
</html>
<script type="text/javascript">
    function member_del(obj,id){
      layer.confirm('确认要删除吗？',function(index){
        $.ajax({
          url:"<?php echo U('Goods/delColorAttr');?>",
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
</script>