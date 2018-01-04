<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
		<script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
<title>积分管理</title>
</head>

<body>
<div class="margin clearfix">
 <div class="" id="Other_Management">
 <div class="search_style">
      <div class="title_names">搜索查询</div>
         <form action="<?php echo U('Score/index');?>" method="get">
      <ul class="search_content clearfix">
       <li><label class="l_f">会员名称</label><input name="names" type="text" class="text_add" placeholder="输入会员名称" style=" width:400px" value="<?php echo ($name); ?>"></li>
       <li style="width:90px;"><button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
      </ul>
        </form>
    </div>
    <div class="border clearfix">
   
       <span class="r_f">共：<b><?php echo ($total); ?></b>条</span>
     </div>
     <div class="list_style">
     <table class="table table-striped table-bordered table-hover" id="sample-table">
     <thead>
         <tr>
                
                <th width="80">用户ID</th>
                <th width="220">用户账号</th>
                <th width="120">总积分</th>
            
                <th width="250">积分详情</th>              
                <th width="200">操作</th>
            </tr>
        </thead>
    <tbody>
     <?php if(is_array($user)): foreach($user as $key=>$vv): ?><tr>
      
        <td><?php echo ($vv['id']); ?></td>
        <td><?php echo ($vv['account']); ?></td>
        <td><?php echo ($vv['score']); ?></td>
       
        <td><a href="<?php echo U('Score/getScoreDetail',['uid'=>$vv['id'],'name'=>$vv['account']]);?>"  class="btn btn-xs btn-info"><i class="icon-edit bigger-120">查看</i></a></td>
        <td> <a title="删除" href="javascript:;"  onclick="member_del(this,)" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a></td>
        </tr><?php endforeach; endif; ?>
        </tbody>    
     </table>     
     </div>
     
 </div>
</div>


</body>
</html>
<script>



/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){


		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}




</script>