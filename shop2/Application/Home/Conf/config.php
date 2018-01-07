<?php
return array(
	//'配置项'=>'配置值'
	/* 连接redis*/
	'REDIS_HOST' => '127.0.1',
	'REDIS_PORT' => 6379,



	'DATA_CACHE_TYPE' => 'Memcache',//缓存方式
	'MEMCACHE_HOST' => 'tcp://127.0.0.1:11211',// 缓存服务器地址
	'DATA_CACHE_TIME' => '60',//指定默认的缓存时长为3600 秒,没有会出错

	/* 路由 */
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则  

		'mycart'             => 'Cart/showMyCartView',   // 显示购物车页
		'addcart'            => 'Cart/addMyCart',        // 添加购物车处理
		'delcart'            => 'Cart/deleteCartData',   // 删除购物车信息
		'delallcart'         => 'Cart/delAllCartData',   // 删除多条购物车信息
		'donumber'           => 'Cart/handlerCartNumber',    // 减少和添加购物车里的购买量
		'account'            => 'Order/handlerCartAjaxData',   // 显示订单页
		'orders'            => 'Order/showOrderView',
		'getress'           => 'Order/getAddressData', 
		'address'           => 'Order/handlerAddress',
		'delress'           => 'Person/delAddressData',
		'referorders'       => 'Order/handlerSubmitOrderData',
	),
	'URL_MODEL' => 2
);