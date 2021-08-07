<?php
require('dbconnect.php');
session_start();

$id = (int)$_SESSION['user_id']['id'];

	$tweets = $db -> query('SELECT * FROM tweets, users WHERE users.id=tweets.user_id');

	$stmt = $db -> prepare('SELECT * FROM tweets WHERE id=?');
	$stmt -> execute(array($_GET['reply']));
	$reply = $stmt -> fetch();

	$reply_id = (int)$reply['id'];

	if (!empty($_POST)){
		if ($_POST['content'] !== ''){
			$stmt = $db -> prepare('INSERT INTO tweets SET content=?, user_id=?, reply_id=?, created_at=NOW()');
			$stmt -> execute(array($_POST['content'], $id, $reply_id));
			header('Location: index.php');
			exit();
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
<a href="mypage.php?id=<?php echo $id; ?>">マイページへ</a>

<form action="" method="post">
	<p><label for="content">投稿</label></p>
	<textarea name="content" id="content" cols="30" rows="10">@<?php print($reply['content']); ?></textarea>
	<button type="submit">投稿</button>
</form>


<h2>投稿一覧</h2>
<?php if (!empty($tweets)): ?>
	<?php foreach ($tweets as $tweet): ?>
		<hr>
		<p><a href="mypage.php?id=<?php echo $tweet['user_id']; ?>"><?php echo htmlspecialchars($tweet['name'],  ENT_QUOTES); ?></a></p>
		<p><?php echo htmlspecialchars($tweet['content'],  ENT_QUOTES); ?></p>
		<p><?php echo htmlspecialchars($tweet['created_at'],  ENT_QUOTES); ?></p>
		<a href="index.php?reply=<?php echo $tweet[0]; ?>">返信する</a>
	<?php endforeach; ?>
<?php endif; ?>

<p><a href="tweet.php">投稿する</a></p>
</body>
</html>