<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8/>
    <title>s</title>
        <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/shop2/Public/css/style.css"/>       
        <link href="/shop2/Public/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/shop2/Public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/shop2/Public/font/css/font-awesome.min.css" />
        <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script>
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>


 
</head>
<body>
<br>
<div class="panel panel-default " >
    <div class="panel-body">
        <h2>修改管理员信息</h2>
    </div>
</div>

 <!--修改管理员-->
 <div class="container " ></div><br>
<br>
 <div id="medit"  class="container "  >
    <form action="" method="post"  >
        <div class="form-group">
            <label class="form-label"><span class="c-red">*</span>管理员：</label>
            <div class="formControls">
                <input type="text" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="用户名不能为空">
            </div>
            <div class="col-4"> <span class="Validform_checktip"></span></div>
        </div>
       
        <div class="form-group">
            <label class="form-label "><span class="c-red">*</span>性别：</label>
            <div class="formControls  skin-minimal">
              <label><input name="form-field-radio" type="radio" checked="checked"><span class="lbl">保密</span></label>&nbsp;&nbsp;
            <label><input name="form-field-radio" type="radio" ><span class="lbl">男</span></label>&nbsp;&nbsp;
            <label><input name="form-field-radio" type="radio" ><span class="lbl">女</span></label>
            </div>
            <div class="col-4"> <span class="Validform_checktip"></span></div>
        </div>
        <div class="form-group">
            <label class="form-label "><span class="c-red">*</span>手机：</label>
            <div class="formControls ">
                <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="手机不能为空">
            </div>
            <div class="col-4"> <span class="Validform_checktip"></span></div>
        </div>
        
        <div class="form-group">
            <label class="form-label">角色：</label>
            <div class="formControls "> <span class="select-box" style="width:150px;">
                <select class="select" name="admin-role" size="1">
                    <option value="0">超级管理员</option>
                    <option value="1">管理员</option>
                    <option value="2">栏目主辑</option>
                    <option value="3">栏目编辑</option>
                </select>
                </span> </div>
        </div>
    
        <div> 
        <a class="btn btn-primary radius" href="<?php echo U('Rbac/rules');?>" id="Add_Administrator" >返回</a>&nbsp;&nbsp;&nbsp; <input class="btn btn-primary radius" type="submit" id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
    </form>
   </div>

</body>
<script type="text/javascript">
        //表单验证提交
$("medit").Validform({
        
         tiptype:2,
    
        callback:function(data){
        //form[0].submit();
        if(data.status==1){ 
                layer.msg(data.info, {icon: data.status,time: 1000}, function(){ 
                    location.reload();//刷新页面 
                    });   
            } 
            else{ 
                layer.msg(data.info, {icon: data.status,time: 3000}); 
            }         
            var index =parent.$("#iframe").attr("src");
            parent.layer.close(index);
            //
        }
        
        
    }); 
</script>
</html>