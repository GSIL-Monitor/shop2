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
<br><br>

 <div id="medit"  class="container "  >
    <form action="" method="post"  id="ani">
    <input type="hidden" name="id" value="<?php echo ($id); ?>">
        <div class="form-group">
     <span class="c-red"><h3>管理员：<?php echo ($name); ?></h3></span><br>
            




       
        <table>
                <?php if(is_array($allRoles)): foreach($allRoles as $key=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?><input type="checkbox"

                                <?php if(in_array(($v["id"]), is_array($groups)?$groups:explode(',',$groups))): ?>checked<?php endif; ?>
                             
                         name="role[]" value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></td>
                    </tr><?php endforeach; endif; ?>
        </table>

<br>
        <a class="btn btn-primary radius" href="<?php echo U('Rbac/admins');?>" id="Add_Administrator" >返回</a>&nbsp;&nbsp;&nbsp;    <button  class="btn btn-primary radius" type="submit" id="submit">提交</button>
</div>
    </form>

    

</div>

</body>
<script type="text/javascript">
        //表单验证提交
/*$("medit").Validform({
        
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
        
        
    }); */

$(function(){  
      var dataformInit = $("#ani").serializeArray();   
      var jsonTextInit = JSON.stringify({ dataform: dataformInit });  
      $("#submit").click(function(){  
             var dataform = $("#ani").serializeArray();  
             var jsonText = JSON.stringify({ dataform: dataform });  
             if(jsonTextInit==jsonText)  
             {   
                     alert("您并未作出任何修改");  
                     return false;  
             }  
  
      })  
  
}) 
</script>
</html>