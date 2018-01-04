<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		<script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>  
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
		<script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
		<script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
                      
<title>个人信息管理</title>
</head>

<body>
<div class="clearfix">
 <div class="admin_info_style">
   <div class="admin_modify_style" id="Personal">
    <div class="type_title">管理员信息 </div>
      <div class="xinxi">
        <form action="<?php echo U('editAdminData');?>" method="post" id="add">
            <input type = "hidden" name="id" value="<?php echo ($data['id']); ?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">用户名： </label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="aniq" value="<?php echo ($data['name']); ?>" class="col-xs-7 text_info" disabled="disabled">
                             &nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="change_Password(<?php echo ($data['id']); ?>)" class="btn btn-warning btn-xs">修改密码</a>
                        </div>
                      
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">性别： </label>
                      <div class="col-sm-9">
                      <span class="sex">
                      <?php if ($data['sex']==1) {echo "男";} elseif ($data['sex']==0) {echo "女";} else {echo "保密";}?>
                      </span>
                        <div class="add_sex">
                        <label><input name="sex" type="radio" value="2"  class="anie" checked ><span class="lbl">保密</span></label>&nbsp;&nbsp;
                        <label><input name="sex" type="radio" value="1"  class="anie" <?=$data['sex']=='1'?'checked':''?>><span class="lbl">男</span></label>&nbsp;&nbsp;
                        <label><input name="sex" type="radio" value="0"  class="anie" <?=$data['sex']=='0'?'checked':''?>><span class="lbl">女</span></label>
                        </div>
                       </div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">          联系号码： </label>
                            <div class="col-sm-9"><input type="text" name="phone" id="ani" value="<?php echo ($data['phone']); ?>" class="col-xs-7 text_info" disabled="disabled"></div>
                    </div>
                    
                       <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">权限： </label>
                      <div class="col-sm-9" > <span><?php echo ($role); ?></span></div>
                      </div>
                       <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">注册时间： </label>
                      <div class="col-sm-9" > <span><?php echo ($data['addtime']); ?></span></div>
                      </div>
                       <div class="Button_operation clearfix"> 
                            <button onclick="modify();" class="btn btn-danger radius" type="button">修改信息</button>               
                            <button  class="btn btn-success radius" type="submit"  id="subb">保存修改</button>               
                        </div>
                </form>
            </div>

    </div>
    <div class="recording_style">
    <div class="type_title">管理员列表 </div>
    <div class="recording_list">
     <table class="table table-border table-bordered table-bg table-hover table-sort" id="sample-table">
    <thead>
      <tr class="text-c">
        <th width="25"><label><input type="radio"  class="ace"><span class="lbl"></span></label></th>
         <th width="50">ID</th>
        <th width="70">用户名</th>
      <th width="100">最后登录IP</th>
        <th width="15%">联系号码</th>
        <th width="10%">状态</th>
        <th width="70">登录次数</th>
        <!-- <th width="120">登录地址</th> -->
        <th width="130">最后一次登录时间</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><tr>
        <td><label><input type="radio" checked class="ace"><span class="lbl"></span></label></td>
        <td><?php echo ($vo['uid']); ?></td>
        <td><?php echo ($vo['name']); ?></td>
        <td><?php echo ($vo['ip']); ?></td>
        <td><?php echo ($vo['phone']); ?></td>
        <td>正常</td>
        <td><?php echo ($vo['number']); ?></td>
        <!-- <td>61.233.7.80</td> -->
        <td><?php echo ($vo['logintime']); ?></td>      
      </tr><?php endforeach; endif; ?>
        
    </tbody>
  </table>
    </div>
    </div>
 </div>
</div>
 <!--修改密码样式-->
         <div class="change_Pass_style" id="change_Pass">
            <ul class="xg_style">
           
             <li><label class="label_name">新&nbsp;&nbsp;密&nbsp;码</label><input name="新密码" type="password" class="" id="Nes_pas"></li>
             <li><label class="label_name">确认密码</label><input name="再次确认密码" type="password" class="" id="c_mew_pas"></li>
              
            </ul>
     <!--       <div class="center"> <button class="btn btn-primary" type="button" id="submit">确认修改</button></div>-->
         </div>
</body>
</html>
<script>

 //按钮点击事件
function modify($id){
	 $('.text_info').attr("disabled", false);
	 $('.text_info').addClass("add");
	  $('#Personal').find('.xinxi').addClass("hover");
	  $('#Personal').find('.btn-success').css({'display':'block'});
     var dataformInit = $("#add").serializeArray();   
      var jsonTextInit = JSON.stringify({ dataform: dataformInit }); 
      // console.log(dataformInit); 
      console.log(jsonTextInit);
      $("#subb").click(function(){  
             var dataform = $("#add").serializeArray();  
             var dataform = $("#add").serializeArray();  
             var jsonText = JSON.stringify({ dataform: dataform });  
             console.log(jsonText);
             if(jsonTextInit == jsonText)  
             {      
                     layer.alert("您并未作出任何修改");  
                     return false;  
             }  
  
      })  
	};
function save_info(){
	    var num=0;
		 var str="";

     $(".xinxi input[type$='text']").each(function(n){
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
        
	};	
 //初始化宽度、高度    
    $(".admin_modify_style").height($(window).height()); 
	$(".recording_style").width($(window).width()-400); 
    //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".admin_modify_style").height($(window).height()); 
	$(".recording_style").width($(window).width()-400); 
  });
  //修改密码
  function change_Password(id){
    var uid = id; 
     layer.open({
    type: 1,
	title:'修改密码',
	area: ['300px','300px'],
	shadeClose: true,
	content: $('#change_Pass'),
	btn:['确认修改'],
	yes:function(index, layero){		

		  if ($("#Nes_pas").val()==""){
			  layer.alert('新密码不能为空!',{
              title: '提示框',				
				icon:0,
			    
			 });
			return false;
          } 
		   
		  if ($("#c_mew_pas").val()==""){
			  layer.alert('确认新密码不能为空!',{
              title: '提示框',				
				icon:0,
			    
			 });
			return false;
          }
		    if(!$("#c_mew_pas").val || $("#c_mew_pas").val() != $("#Nes_pas").val() )
        {
            layer.alert('密码不一致!',{
              title: '提示框',				
				icon:0,
			    
			 });
			 return false;
        }   
		 else{	

         $.ajax({
          url: "<?php echo U('Rbac/changePassword');?>",
          type: "post",
          data: "id="+id+"&newpass="+$("#Nes_pas").val(),
          success: function (msg) {

              if (msg['code'] == 1200) {
                 
                 
                  layer.alert('修改成功',{
                         title: '提示框',        
                icon:1,   
                  }); 
			  layer.close(index);  
                

              } 
          },
          dataType: "json"
      });    


		  }	 
	}
    });
	  }
</script>
<script>
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,6]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
});

// $(function(){  

  
// });


</script>