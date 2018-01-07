<?php

namespace Home\Model;

use Think\Model;

class UserModel extends Model
{
	// protected $tableName = 'user';
	


	protected $_validate = [
	
		['verify','require','验证码必须！'],
		['account','require','用户名必填'],
		['email','require','邮箱必填'],
		['account','','用户名已存在',0,'unique',1],
		['account','/^[a-z|A-Z]\w{3,12}$/','用户名必须字母开头,且不能有特殊符号,4~12位'],
		['password','/^[\x21-\x2f\x3a-\x40\x5b-\x60\x7B-\x7F,\w]{6,20}$/','密码必须6~20位'],
		['email','','手机号已存在',0,'unique',1],
		['email','/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/','邮箱格式不正确'],
		['conf_password','password','两次密码不一致',0,'confirm']

	];
	
}