<?php
require('dbconnect.php');
session_start();

$id = (int)$_SESSION['user_id']['id'];

	$tweets = $db -> query('SELECT * FROM tweets, users WHERE users.id=tweets.user_id');


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
<a href="mypage.php?id=<?php echo $id; ?>">マイページへ</a>

<h2>投稿一覧</h2>
<?php if (!empty($tweets)): ?>
	<?php foreach ($tweets as $tweet): ?>
		<hr>
		<p><a href="mypage.php?id=<?php echo $tweet['user_id']; ?>"><?php echo htmlspecialchars($tweet['name'],  ENT_QUOTES); ?></a></p>
		<p><?php echo htmlspecialchars($tweet['content'],  ENT_QUOTES); ?></p>
		<p><?php echo htmlspecialchars($tweet['created_at'],  ENT_QUOTES); ?></p>
	<?php endforeach; ?>
<?php endif; ?>

<p><a href="tweet.php">投稿する</a></p>
</body>
</html>