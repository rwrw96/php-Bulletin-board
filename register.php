<?php 
	require('dbconnect.php');
	session_start();

	if(!isset($_SESSION['user_id'])){
		header('Location: signup.php');
		exit();
	}

	$stmt = $db -> prepare('SELECT * FROM users WHERE id=?');
	$stmt -> execute(array($_SESSION['user_id']['id']));
	$about_user = $stmt -> fetch();

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
	<h3>登録完了！！</h3>
	<?php 
		echo 'あなたの名前は'. htmlspecialchars($about_user['name'], ENT_QUOTES) . 'ですね'. "<br>";
		echo 'メールアドレスは'. htmlspecialchars($about_user['email'], ENT_QUOTES) . 'ですね'. "<br>";
		echo 'パスワードは' . htmlspecialchars($about_user['password'], ENT_QUOTES) . 'ですね'. "<br>";
		?>
</body>
</html>