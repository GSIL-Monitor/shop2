<?php

$redis = new Redis();

$redis->connect('localhost', 6379);

$pdo = new PDO('mysql:host=localhost; dbname=shop2; charset=utf8', 'root', '123456');

$data = $redis->smembers('set:cart');

for ($i=0; $i < count($data); $i++) { 

	$cartDataKey = 'cart:'.$data[$i];

	$cartData = $redis->hmget($cartDataKey, ['gid', 'uid', 'sid']);

	$insertDataSql = "insert into think_buycart(gid, uid, sid) values({$cartData['gid']}, {$cartData['uid']}, {$cartData['sid']})";

	$pdo->exec($insertDataSql);

	$redis->sRem('set:cart', $data[$i]);
}