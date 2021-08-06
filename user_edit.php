<?php 
require('dbconnect.php');
session_start();

$id = (int)$_SESSION['user_id']['id'];

if (!$id){
	header('Location: login.php');
}

$stmt = $db -> prepare('SELECT * FROM users WHERE id=?');
$stmt -> execute(array($id));
$user = $stmt -> fetch();
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
  <form action="mypage.php?id=<?php echo $id; ?>" method="post">
		<p><label for="name">お名前</label></p>
		<input type="text" name="name" id="name" value="<?php echo $user['name']; ?>">
		<p><label for="email">メールアドレス</label></p>
		<input type="text" name="email" id="email" value="<?php echo $user['email']; ?>">
		<button type="submit">更新する</button>
	</form>
</body>
</html>