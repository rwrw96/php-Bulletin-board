<?php
require('dbconnect.php');
session_start();

$id = (int)$_SESSION['user_id']['id'];

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
<a href="mypage.php?=<?php echo $id; ?>">マイページへ</a>
</body>
</html>