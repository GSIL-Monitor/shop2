<?php

$pdo = new PDO('mysql:host=localhost;dbname=shop2;charset=utf8','root','123456');

$sql = 'select id, addtime from think_orders where status=1';

$stmt = $pdo->query($sql);

$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr as $v) {
	
	$mydate = $v['addtime'];
	$mydate = strtotime($mydate)+3600*24;
	$nowdate = time();

	if ($mydate < $nowdate) {

		$updateData[] = $v['id'];
	}
}

if (@$updateData) {

	foreach ($updateData as $val) {

		$sql = 'update think_orders set status=5 where id = '.$val.'';

		$pdo->exec($sql);

		$getSql = 'select sid, gid, num from think_order_detail where oid ='.$val.'';

		$stmt = $pdo->query($getSql);
		$detailArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($detailArr as $value) {

			$upNumDataSql = 'update think_goods_size set num=num+'.$value['num'].' where id='.$value['sid'].'';
			$pdo->exec($upNumDataSql);

			$upBuyNumDataSql = 'update think_goods set num=buynum-'.$value['num'].' where id='.$value['gid'].'';
			$pdo->exec($upBuyNumDataSql);
		}
	}
}