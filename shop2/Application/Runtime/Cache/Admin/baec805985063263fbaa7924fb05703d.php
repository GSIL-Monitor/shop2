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
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->
        <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
        <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>   
        <script src="/shop2/Public/js/lrtk.js" type="text/javascript" ></script>       
        <script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
        <script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/shop2/Public/Widget/swfupload/handlers.js"></script>
<title>广告管理</title>
</head>

<body>
<div class="page-content clearfix">
 <div class="sort_adsadd_style">
  <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:;"  id="ads_add"  class="btn btn-warning Order_form"><i class="fa fa-plus"></i> 添加规则</a>
       
       </span>
       <span class="r_f">共：<b><?php echo ($total); ?></b>条规则</span>
     </div>
     <?php echo ($pageBtn); ?>
 <!--列表样式-->
    <div class="sort_Ads_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
        <thead>
         <tr>
             
                <th width="90px">ID</th>               
                <th width="120">积分规则</th>
                <th width="240px">获得积分</th>
                <th width="230px">备注(价格区间)</th>
                <th width="230px">操作</th>
    
            </tr>
        </thead>
    <tbody>
        <?php if(is_array($datas)): foreach($datas as $key=>$vo): ?><tr>
    
       <td><?php echo ($vo['id']); ?></td>
       <td><?php echo ($vo['desc']); ?></td> 
      
       
      
       <td><?php echo ($vo['score']); ?></td>
       <td><?php echo ($vo['content']); ?></td>

  
      <td class="td-manage">
          <a title="编辑" href="<?php echo U('editRule',['id'=>$vo['id'] ]);?>" class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
        <a title="删除" href="javascript:;"  onclick="del(this,<?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
      </tr><?php endforeach; endif; ?>

     
    </tbody>
    </table>
     </div>
 
 </div>
</div>  

<!--添加广告样式-->
<div id="add_ads_style"  style="display:none">  
    <form action="<?php echo U('Score/doAddScoreRule');?>" method="post"/>
        <div class="add_adverts">
           <ul>
                <li><label class="label_name">积分规则</label><span class="cont_style"><input name="desc" type="text" id="form-field-1"  class="col-xs-10 col-sm-5" style="width:200px" required></span></li>  
                <li><label class="label_name">获得积分</label><span class="cont_style"><input name="score" type="text" id="form-field-1"  class="col-xs-10 col-sm-5" style="width:200px" required></span></li>  
                <li><label class="label_name">备注</label><span class="cont_style"><input name="content" type="text" id="form-field-1"  class="col-xs-10 col-sm-5" style="width:200px"></span></li>
                <li style="margin-left:100px" width="100px">
                    <input type="submit"   value="提交" >
                </li> 
            </ul>
        </div>
    </form>
</div>



</body>
</html>


<script>



/*删除*/
function del(obj, id) {

    layer.confirm('确认要删除吗？',function(index){

        $.ajax({
            url: "<?php echo U('Score/delScoreRule');?>",
            type: "post",
            data: "id="+id,
            success: function (msg) {

                if (msg['code'] == 1200) {

              
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000}); 
                } else {

                    layer.msg('系统有误! 请尽快联系程序员!!',{icon:1,time:1000});
                }
            },
            dataType: "json"
        });
    });    
}

 $('#ads_add').on('click', function(){
      layer.open({
        type: 1,
        title: '添加积分规则',
        maxmin: true, 
        shadeClose: false, //点击遮罩关闭层
        area : ['800px' , ''],
        content:$('#add_ads_style'),
    
        yes:function(index,layero){ 
         var num=0;
         var str="";
     $(".add_adverts input[type$='text']").each(function(n){
          if($(this).val()=="")
          {
               
               layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
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
})
</script>