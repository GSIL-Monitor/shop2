<?php
namespace Common\Server;

// require './ThinkPHP/Vendor/PHPMailer/class.phpmailer.php';

// use \ThinkPHP\Vendor\PHPMailer;

class EmailServer
{
	//$to, $title, $content
	public function sendEmail($to,$content)
	{
		
	// Vendor('PHPMailer.PHPMailerAutoload');
	Vendor('PHPMailer.class#phpmailer');
	$mail = new \PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->SMTPSecure = 'ssl';
        $mail->Host= 'smtp.qq.com'; //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->Port = 465;
        $mail->SMTPAuth = true; //启用smtp认证
        $mail->Username = 'xiaoale1@qq.com'; //你的邮箱名
        $mail->Password = 'kvxnclpyihlvcajg'; //邮箱密码(授权码)
        $mail->From = 'xiaoale1@qq.com'; //发件人地址（也就是你的邮箱地址）
        $mail->FromName = '福星阁'; //发件人姓名
        $mail->AddAddress($to,"我是美女客服");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(true); // 是否HTML格式邮件
        $mail->CharSet='utf-8'; //设置邮件编码
        $mail->Subject ='请接收验证码'; //邮件主题
        $mail->Body = '您的验证码为'.$content.',时效1分钟请及时输入'; //邮件内容
        $mail->AltBody = "这是一个纯文本的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
        // dump($mail);
        return($mail->Send());
	}
}
?>