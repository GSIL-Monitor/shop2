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
        <h2>修改积分规则</h2> 
    </div>
</div>

 <!--修改管理员-->
<br><br>

 <div id="medit"  class="container " >
  

    <form action="<?php echo U('editRule');?>" method="post" id="ani"/>
        <input type="hidden" name="id" value="<?php echo ($id); ?>"/>

        <div  class="form-group">
           <ul>
                <li><label>积分规则</label><input name="desc" type="text" id="form-field-1"  value="<?php echo ($data['desc']); ?>" style="width:200px" required></li><br>  
                <li><label>获得积分</label><input name="score" type="text" id="form-field-1"  value="<?php echo ($data['score']); ?>" style="width:200px" required></li><br>  
                <li><label>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</label><input name="content" type="text" id="form-field-1"  value="<?php echo ($data['content']); ?>" style="width:200px"></li><br>
                <li style="margin-left:100px" width="100px">
                    <input type="submit"   value="提交" id="submit">
                </li> 
            </ul>
        </div>
    </form>

 

    

</div>

</body>
<script type="text/javascript">


$(function(){  
      var dataformInit = $("#ani").serializeArray();   
      var jsonTextInit = JSON.stringify({ dataform: dataformInit });  
      // console.log(dataformInit);
      console.log(jsonTextInit);
      $("#submit").click(function(){  
             var dataform = $("#ani").serializeArray();  
             var jsonText = JSON.stringify({ dataform: dataform });  
      console.log(jsonText);
             if(jsonTextInit==jsonText)  
             {   
                     alert("您并未作出任何修改");  
                     return false;  
             }  
  
      })  
  
}) 
</script>
</html>