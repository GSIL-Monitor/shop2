<?php
	

	//接受ajax发送过来的
	$name = $_GET['name'];

	$pdo = new PDO('mysql:host=localhost;dbname=shop2;charset=utf8', 'root', '123456');

	$sqlTpl = 'select name from think_admin where name = :name';

	$stmt = $pdo->prepare($sqlTpl);

	$stmt->execute([
		':name' => $name,
	]);

	//拿到查询结果
	$oneUserData = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($oneUserData) {

		//已经存在
		echo json_encode([
			'code' => 1200,
			'msg'  => 'user Found'
		]);
		exit;
	}

	//不存在
	echo json_encode([
		'code' => 1404,
		'msg'  => 'user Not Found'
	]);
	exit;




