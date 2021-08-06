<?php 
require('dbconnect.php');
session_start();

session_destroy();
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
    <h2>ログアウト</h2>
    <p>ログアウト完了しました</p>

    <a href="login.php">ログイン画面へ</a>
</body>
</html>