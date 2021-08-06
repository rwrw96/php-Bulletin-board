<?php 
	require('dbconnect.php');
	session_start();

	$users = $db -> prepare('SELECT * FROM users WHERE email=? AND password=?');
	$users -> execute(array($_POST['email'], $_POST['password']));
	$user = $users -> fetch();
	

	if ($user){	
		$_SESSION['user_id'] = $user;
		header('Location: index.php');
		exit();
	}

	if (!empty($_POST)) {
		if ($_POST['email'] === ''){
			$error['email'] = 'blank';
		}
		if ($_POST['password'] === ''){
			$error['password'] = 'blank';
		}
	}
		
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
  <h2>ログイン</h2>

	<form action="" method="post">
		<p><label for="email">メールアドレス</label></p>
		<?php if ($error['email'] === 'blank'): ?>
			<p>メールアドレスが入力されていません</p>
		<?php endif; ?>
		<input type="text" name="email" id="email">
		<p><label for="password">パスワード</label></p>
		<?php if ($error['password'] === 'blank'): ?>
			<p>パスワードが入力されていません</p>
		<?php endif; ?>
		<input type="text" name="password" id="password">
		<button type="submit">ログインする</button>
	</form>
</body>
</html>