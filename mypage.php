<?php
require('dbconnect.php');
session_start();

$stmt = $db -> prepare('SELECT * FROM users WHERE id=?');
$stmt -> execute(array($_GET['id']));
$user = $stmt -> fetch();


if ($_SESSION['user_id']['id']){
	$id = (int)$_SESSION['user_id']['id'];
}

if (!isset($id) || !$user){
    header('Location: login.php');
}





var_dump($_SESSION['user_id']);
echo $_GET['id'];
var_dump($_FILES['image']);
var_dump($user['image']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h2>プロフィール</h2>
	<h4>あなたの名前：<?php echo $user['name']; ?></h4>
	<h4>あなたのメールアドレス：<?php echo $user['email']; ?></h4>
	<h4>あなたの画像：<img src="user_image/<?php echo $user['image']; ?>"　alt="写真" width="193" height="130"></h4>
	<p><a href='user_edit.php?id=<?php echo $id; ?>'>編集する</a></p>
	<p><a href="logout.php?id=<?php echo $id; ?>">ログアウトする</a></p>
</body>
</html>