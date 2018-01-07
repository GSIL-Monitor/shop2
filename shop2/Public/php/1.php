<?php

	

	
	$pdo  = new PDO('mysql:host=localhost;dbname=shop2;charset=utf8', 'root', '');

	$id = $_POST['cid'];
	$sql = 'delete from think_auth_group where id = ?';

	$stmt = $pdo->prepare($sql);

	$stmt->execute([
		$id,
	]);


	//影响行数
	$afftedRow = $stmt->rowCount();

	if ($afftedRow) {
		
		echo json_encode([
			'code' => 1200,
			'msg'  => 'delete product success',
			// 'data' => $productDatas,
		]);
		exit;
	}

	echo json_encode([
			'code' => 1404,
			'msg'  => 'delete product fail',
			// 'data' => $productDatas,
	]);
	exit;
