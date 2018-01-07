<?php

/**
 * 防止定时任务撞车 
*比如，你有一个每分钟都运行的计划任务，但是这个任务这分钟没有运行完成，下一分钟的计划任务也已经开始了。。这样也许会崩溃我们的服务器的。
*我们可以通过文件锁来解决：
 * 过程：打开文件，判断文件是否锁定，锁定了就退出。这样第一个计划任务没运行结束时，文件不会关闭，也就没有解锁。
*下一个时间触发的计划任务，也尝试打开文件，发现已被锁定，于是退出。这样就不会撞车了。
 */
// $fp = fopen('/tmp/lock.txt', 'r+');   
// if(!flock($fp, LOCK_EX | LOCK_NB)) {   
//     echo 'Unable to obtain lock';   
//     exit(-1);   
// }
// /* ... */  
// fclose($fp);
$redis = new Redis();

$redis->connect('localhost',6379);

$pdo = new PDO('mysql:host=localhost;dbname=shop2;charset=utf8','root','123456');

while ($userName = $redis->rPop('user:data:queue')) {
	
	$key = "data:user:".$userName;

	//取出hash 中所有数据
	$userData = $redis->hGetAll($key);

	//将数据插入到MySQL数据库
	$sql = 'insert into think_user(email,account,password,status,role,id,score) values(?, ?, ?, ?, ?, ?,80)';
	
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array_values($userData));

	$redis->del($key);
}
while ($userName = $redis->rPop('email:data:queue')) {

	$key = 'data:user:email:'.$userName;

	$redis->del($key);

}

while ($uid = $redis->rPop('score:data:queue')) {

	$key = 'data:user:'.$uid;

	//取出hash 中所有数据
	$idData = $redis->hGetAll($key);

	$sql = 'insert into think_user_score(uid,sid) values(?, 1)';
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array_values($idData));

	$redis->del($key);


}
