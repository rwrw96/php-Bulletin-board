<?php 
	require('dbconnect.php');
	session_start();
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];


	$users = $db -> prepare('SELECT * FROM users WHERE email=?');
	$users -> execute(array($_POST['email']));
	$user = $users -> fetch();
	

	if (!empty($_POST)){
		
		if ($_POST['name'] === ''){
			$error['name'] = 'blank';
		}
		if ($_POST['email'] === ''){
			$error['email'] = 'blank';
		}
		if ($_POST['password'] === ''){
			$error['password'] = 'blank';
		}
		if ($user['email'] === $email){
			$error['email'] = 'already';
		}
		
		
		if (empty($error)){
			if ($user['email'] !== $email) {
				$stmt = $db -> prepare('INSERT INTO users SET name=? ,email=?, password=?, created_at=NOW()');
				$stmt -> execute(array($name, $email, $password));
				$user_id = $db -> prepare('SELECT id FROM users WHERE name=? AND email=? AND password=?');
				$user_id -> execute(array($name, $email, $password));
				$_SESSION['user_id'] = $user_id -> fetch();
				
				header('Location: register.php');
				exit();
			} 
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>
<body>
    <h2>新規登録</h2>
    <form action="" method="post">
			<p><label for="name">名前</label></p>
			<?php if($error['name'] === 'blank'): ?>
				<h4>名前が入力されていません</h4>
			<?php endif; ?>
      <input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>">
			<p><label for="email">メールアドレス</label></p>
			<?php if($error['email'] === 'blank'): ?>
				<h4>メールアドレスが入力されていません</h4>
			<?php endif; ?>
			<?php if($error['email'] === 'already'): ?>
				<h4>そのメールアドレスは既に使用されています</h4>
			<?php endif; ?>
			<input type="text" name="email" id=email value="<?php echo $_POST['email']; ?>">
			<p><label for="password" id="password">パスワード</label></p>
			<?php if($error['password'] === 'blank'): ?>
				<h4>パスワードが入力されていません</h4>
			<?php endif; ?>
			<input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>">
			<button type="submit">登録する</button>
    </form>
</body>
</html>