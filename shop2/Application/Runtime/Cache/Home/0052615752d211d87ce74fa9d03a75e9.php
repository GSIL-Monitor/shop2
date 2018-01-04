<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0058)http://www.pinkyswear.cn/Haoduoyou/Home/Login/findPwd.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<title>修改密码_美丽说</title> 
  <meta name="description" content="美丽说是白领女性时尚消费品牌，为超过1亿注册用户提供导购信息。建立300万全球女性时尚品牌商品库，超过1000家全球品牌达成官方合作导购体验，更好的满足白领女性的时尚消费需求。">
  <meta name="keywords" content="美丽说,美丽说官网,美丽说首页,美丽说登录,导购,白领,女装,网购">	
  
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">	
  <meta name="renderer" content="webkit">	
  <meta name="mobile-agent" content="format=html5;url=http://m.meilishuo.com"> 
  <link rel="icon" href="https://s10.mogucdn.com/mlcdn/c45406/170612_02i668aijej2cb21ji56g98a218dg_48x48.png" type="image/x-icon">	
  <link type="text/css" rel="stylesheet" href="/shop2/Public/Home/css/base-6575225484.css">	
  <link type="text/css" rel="stylesheet" href="/shop2/Public/Home/css/common-ef21baae57.css">
  <script src="/shop2/Public/js/jquery-1.9.1.min.js"></script> 
  <script src="/shop2/Public/assets/layer/layer.js" type="text/javascript" ></script>
</head>
<body>
  <div style="height: 52px; clear: both; display: none;"></div>
  <div class="settings">
    <strong class="settings_title">找回密码</strong> 
    <div class="findPwd" id="findPwd" data-code="" data-token=""> 
    
    
    <div class="findPwdForm">
      <form action="<?php echo U('Login/doFindPwd');?>" method="post">
      <input type="hidden" class="hidden" name="email" value="<?php echo ($email); ?>"> 
      <div class="form-list ">
        <hr>
        <h2>修改密码:</h2>
        <br>
        <div class="form-list ">
          <p class="reg_box">
          <label class="account-label">新密码:</label> 
          <input id="new_password" name="new_password" class="password" type="password" placeholder="新密码"/>
          <span id="new_iemail"></span>
          <span class="email_span"></span>
          </p>
          
      </div>
      <div class="pw_safe none_f">
            <span class="txt">安全程度</span>
            <div class="pw_strength pw_weak pw_medium pw_strong">
                <div class="pw_bar"></div>
                <div class="pw_letter">
                    <span class="strength_l">弱</span>
                    <span class="strength_m">中</span>
                    <span class="strength_h">强</span></div>
            </div>
        </div>
      <div class="form-list ">
        <label class="account-label">重复密码:</label> 
        <input id="re_password" name="re_password" class="password" type="password" placeholder="重复密码">
        <span id="iemail"></span>
        <span class="email_span"></span>
      </div>
      <div class="d_none">
      <button style="margin-left: 180px" id="change" data-captcha="" class="ext_submit check_password" value="">下一步</button>
      <span class="errorMessageText color-pink"></span>
    </div>
    </form>

  </div> 
</div>
</div>
  </body>
  </html>
<script type="text/javascript">

  var strongPwd = false;//密码强度
    //密码强度验证
    $('#new_password').keyup(function(){
        var num = $(this).val();
        if (num.length >= 6) {
            var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");//密码八位以上必须包含大小写特殊符号
            var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");//字母数字混合
            var enoughRegex = new RegExp("(?=.{6,}).*", "g");
            $('.pw_safe').attr('style','display:block;');
            if (enoughRegex.test(num)) {
                $('.strength_l').addClass('pw_strength_color');
                strongPwd = false;
            }
            if (mediumRegex.test(num)) {
                $('.strength_m').addClass('pw_strength_color');
                strongPwd = true;
            }else{
                $('.strength_m').removeClass('pw_strength_color');
            }
            if(strongRegex.test(num)){
                $('.strength_m').addClass('pw_strength_color');
                $('.strength_h').addClass('pw_strength_color');
                strongPwd = true;
            }else{
                $('.strength_h').removeClass('pw_strength_color');
            }
        }else{
            $('.pw_safe').attr('style','display:none;');
            strongPwd = false;
        }
    });
    $('#re_password').keyup(function(){
      var obj= $(this);
      if (obj.val() == $('#new_password').val()) {
        $('#iemail').text('密码一致');
      }else{
        $('#iemail').text('密码不一致');
      }
    });

    


  
</script>