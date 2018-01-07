<?php
return array(
	//'配置项'=>'配置值'
    //'配置项'=>'配置值'
     /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',            // 数据库类型
    'DB_HOST'               =>  '192.168.35.198',   // 服务器地址
    'DB_NAME'               =>  'shop2',            // 数据库名
    'DB_USER'               =>  'root',             // 用户名
    'DB_PWD'                =>  '123456',           // 密码
    'DB_PORT'               =>  '',                 // 端口
    'DB_PREFIX'             =>  'think_',           // 数据库表前缀

    /* 上传图片的设置 */
    'PIC_MAXSIZE'           =>  3145728,            // 图片上传的大小
    'PIC_TYPE'              =>  array('jpg', 'gif', 'png', 'jpeg'),
                                                    //上传图片的类型
    'PIC_ROOTPATH'          =>  './Public/Uploads/', //上传图片的路径

    /* 分页设置 */
    'COUNT_NUM'             =>   5,                  //分页条数

    'REDIS_HOST'            => 'localhost',
    'REDIS_PORT'            => 6379,
    

    // 'SHOW_PAGE_TRACE' =>true,

    // 'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
    // 'DEFAULT_MODULE'       =>    'Home',  // 默认模块 
);
