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
        <script src="/shop2/Public/assets/js/bootstrap.min.js"></script>
        <script src="/shop2/Public/assets/js/typeahead-bs2.min.js"></script>              
        <script src="/shop2/Public/assets/js/jquery.dataTables.min.js"></script>
        <script src="/shop2/Public/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/shop2/Public/assets/laydate/laydate.js" type="text/javascript"></script>
<title>管理权限</title>
</head>

<body>
 <div class="margin clearfix">
   <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('addRole');?>" class="btn btn-warning" title="添加权限"><i class="fa fa-plus"></i> 添加角色</a>
        <a href="javascript:;" class="btn btn-danger " id="piliang"><i class="fa fa-trash"></i> 批量删除</a>
       </span>
       <span class="r_f" style="margin-right:30px;font-size:16px">共：<b><?php echo ($num); ?></b>类</span>
     </div>
     <div class="compete_list">
       <table id="sample-table" class="table table-striped table-bordered table-hover">
         <thead>
            <tr>
              <th class="center"><label ><input type="checkbox" class="ace" ><span class="lbl"></span></label></th>
              <th>ID</th>
              <th>角色名称</th>
              <th class="hidden-480">描述</th>             
              <th class="hidden-480">操作</th>
             </tr>
            </thead>
             <tbody>
              <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                <td class="center"><label><input type="checkbox" class="ace" name="idq" value="<?php echo ($vo["id"]); ?>"><span class="lbl"></span></label></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td><?php echo ($vo["desc"]); ?></td>
                <td>
                 <a title="编辑"  href="<?php echo U('editRoleData',['rules'=>$vo['rules'],'id'=>$vo['id'] ]);?>"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
                 <a title="删除" href="javascript:;"  onclick="del(this, <?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-warning" ><i class="fa  fa-trash  bigger-120"></i></a>
                </td>
               </tr><?php endforeach; endif; ?>                                                     
              </tbody>
            </table>
     </div>
 </div>
 
</body>
</html>
<script type="text/javascript">
$("#piliang").click(function(){
        var statu = confirm("确认删除选中项吗！");
        if(!statu)//如果点击的是取消
        {
            return false;//返回页面
        }
      
        var checkedNum = $("input[name='idq']:checked").length; 
        if(checkedNum == 0) { 
        alert("请选择至少一项！"); 
        return; 
        }
       
        var checkedList = new Array(); 
        $("input[name='idq']:checked").each(function() { 
            that = $(this);
        checkedList.push($(this).val()); 
        });  
        // console.log(checkedList);
        
        // console.log(checkedList.toString());
        $.ajax({
            url: "<?php echo U('Rbac/delRoleData');?>",
            type: "post",
            data: "id="+checkedList.toString(),
            success: function (msg) {

                if (msg['code'] == 1200) {
                    for(var i=0; i<checkedList.length; i++){
                        if( $("input[name='idq']:checked").val() == checkedList[i]) {
                                $("input[value ='checkedList[i]']").parents("tr").remove();
                                   layer.msg('已删除!',{icon:1,time:1000});
                                   window.location.reload(); 
                        }
                    }
                } else {

                    layer.msg('系统有误! 请尽快联系程序员!!',{icon:1,time:1000});
                }
            },
            dataType: "json"
        });

});


jQuery(function($) {
        var oTable1 = $('#sample_table').dataTable( {
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
          //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
          {"orderable":false,"aTargets":[0,2,3,4,5,7,8,]}// 制定列不参与排序
        ] } );
                
                
                $('table th input:checkbox').on('click' , function(){
                    var that = this;
                    $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });
                        
                });
            
            
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
            });

 /*权限-删除*/

function del(obj, id) {

    layer.confirm('确认要删除吗？',function(index){

        $.ajax({
            url: "<?php echo U('Rbac/delRoleData');?>",
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
/*修改权限*/
// function Competence_modify(id){
//         window.location.href ="Competence.html?="+id;
// };  
/*字数限制*/
function checkLength(which) {
    var maxChars = 200; //
    if(which.value.length > maxChars){
       layer.open({
       icon:2,
       title:'提示框',
       content:'您出入的字数超多限制!',   
    });
        // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
        which.value = which.value.substring(0,maxChars);
        return false;
    }else{
        var curr = maxChars - which.value.length; //250 减去 当前输入的
        document.getElementById("sy").innerHTML = curr.toString();
        return true;
    }
};

</script>