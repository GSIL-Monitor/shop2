<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <!-- <link href="/shop2/Public/assets/css/bootstrap.min.css" rel="stylesheet" /> -->
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
        <script src="/shop2/Public/js/dragDivResize.js" type="text/javascript"></script>
<title>添加权限</title>
</head>



<body>
<div class="Competence_add_style clearfix">
  <div class="left_Competence_add">
   <div class="title_name">添加管理员</div>
    <div class="Competence_add">
    <form action="<?php echo U('Rbac/addAdmin');?>"  method="post" id="form1">
        <!-- <input type="hidden" name="id" value="<?php echo ($id); ?>"> -->
        <div class="form-group">
            <div class="col-sm-9">用户名&nbsp;&nbsp; <input type="text" id="keke" placeholder=""   name="name" class="col-xs-10 col-sm-5"></div>
        </div><br>    
        <div class="form-group">
            <div class="col-sm-9">密码&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="password" id="kaka"  placeholder=""   name="password" class="col-xs-10 col-sm-5"></div>
        </div><br>    
        <div class="form-group"> 
            <div class="col-sm-9">重复密码<input type="password"  placeholder=""  id="kiki"  name="password2" class="col-xs-10 col-sm-5"></div>
        </div><br>  
         <div class="form-group">
            <div class="col-sm-9">性&nbsp;&nbsp;&nbsp;&nbsp;别 &nbsp;&nbsp;&nbsp;&nbsp;<label><input name="sex" type="radio" value="1" checked="checked" class="ace"><span class="lbl">男</span></label>&nbsp;&nbsp;&nbsp;<label><input name="sex" type="radio" value="0"  class="ace"><span class="lbl">女</span></label>&nbsp;&nbsp;&nbsp;<label><input name="sex" type="radio" class="ace" value="2"><span class="lbl">保密</span></label></div><br>
        </div>
       <div class="form-group">
            <div class="col-sm-9">联系号码<input name="phone" type="text"  />
        </div></div><br>

   <!--按钮操作-->
   <div class="Button_operation" >
                <button  class="btn btn-primary radius" type="submit" id="submit"><i class="fa fa-save "></i> 保存并提交</button>
                <button  class="btn btn-secondary  btn-warning" type="button"><i class="fa fa-reply"></i><a href="<?php echo U('admins');?>">返回上一步</a></button>
                <button  class="btn btn-default radius" type="reset">&nbsp;&nbsp;取消&nbsp;&nbsp;</button> 
    </div>
   </div>
   </div>
   <!--权限分配-->
   <div class="Assign_style">
        <div class="title_name">所属部门</div>

        <br>


    <?php if(is_array($group)): foreach($group as $key=>$vo): ?><div class="form-group">
            <div class="col-sm-9" id="cici"><input type="CheckBox" id="form-field-1" placeholder=""  value="<?php echo ($vo['id']); ?>" name="group[]" class="col-xs-10 col-sm-5"><?php echo ($vo['title']); ?></div>
        </div><?php endforeach; endif; ?>
  
  </div>
        </form>
</div>
</body>
</html>
<script type="text/javascript">
//初始化宽度、高度  
 $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();; 
 $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
 $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
    
    $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
    $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
    $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
    });



    $('#keke').blur(function () {
            
            var usernameVal = $(this).val();//获取到input的value


                $(this).nextAll('span').remove();

            // if (usernameVal.length == 0) {

              
            //     $(this).after('<span style="color:red">用户名不能为空</span>');

            //     return false;
            // }

            // console.log($(this).attr('title'));

            if (usernameVal == $('#keke').attr('title') ) {

                return false;
            }

            $.post(
                "<?php echo U('checkAdminExist');?>",//请求的php的路径
                {name: usernameVal},//要发送的数据，$_POST['name']

                //data可以拿到php响应回来的数据
                function (data) {
                   
                    $('#keke').attr('title', usernameVal);
                    if (data.code == 1200) {

                        $('#keke').after('<span style="color:red">用户已经存在</span>');
                        $('#keke').val(''); 

                    } 

                },
                'json'//php响应回来的数据的格式
            );
        });



    $('#kiki').blur(function () {

        var pap = $('#kiki').val();
        var pp = $('#kaka').val();
        $(this).nextAll('span').remove();

        if (pap.length == 0) {

            $(this).after('<span style="color:red">&nbsp;重复密码不能为空</span>');
            return false;

        }

        if (pp != pap) {

            $(this).after('<span style="color:red">&nbsp;两次密码不一致</span>');


        }

    })


    $("#submit").click(function(){

        if ($("#keke").val()=="") {

            layer.alert('名字不能为空!',function(index){          
                $("input[name='name']").focus();
                layer.close(index);
            });
            return false;
        }       

        if ($("#kaka").val()=="") {
            layer.alert('密码不能为空!',function(index){
                $("input[name='password']").focus();
                layer.close(index);
              
            });
            return false;
        } 
       
        if ($("#kiki").val()=="") {
            layer.alert('重复密码不能为空!',function(index){
                $("input[name='password2']").focus();
                layer.close(index);
              
            });
            return false;
        }      




  })
    
</script>