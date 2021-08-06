<?php 
require('dbconnect.php');
session_start();

$id = (int)$_SESSION['user_id']['id'];

if (!empty($_POST['content'])){
	$stmt = $db -> prepare('INSERT INTO tweets SET content=?, user_id=?, created_at=NOW()');
	$stmt -> execute(array($_POST['content'], $id));
	header('Location: index.php');
	exit();
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
  <form action="" method="post">
		<p><label for="content">投稿</label></p>
		<textarea name="content" id="content" cols="30" rows="10"></textarea>
		<button type="submit">投稿する</button>
	</form>
</body>
</html>