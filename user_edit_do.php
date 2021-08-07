<?php  
require('dbconnect.php');
session_start();

$file_name = $_FILES['image']['name'];
$stmt = $db -> prepare('SELECT * FROM users WHERE id=?');
$stmt -> execute(array($_GET['id']));
$user = $stmt -> fetch();

if ($_SESSION['user_id']['id']){
	$id = (int)$_SESSION['user_id']['id'];
}

if ($id == $_GET['id']){
    if (isset($_POST['name']) && isset($_POST['email'])){
        $stmt = $db -> prepare('UPDATE users SET name=?,email=?, updated_at=NOW() WHERE id=?');
        $stmt -> execute(array($_POST['name'], $_POST['email'], $id));
    }
    
    if ($file_name !== ''){
        move_uploaded_file($_FILES['image']['tmp_name'], 'user_image/' . $_FILES['image']['name']);
        $stmt = $db -> prepare('UPDATE users SET image=?,updated_at=NOW() WHERE id=?');
        $stmt -> execute(array($_FILES['image']['name'],$id));
    } else {
        $stmt = $db -> prepare('UPDATE users SET image=?,updated_at=NOW() WHERE id=?');
        $stmt -> execute(array($user['image'],$id));
    }
}   
    header("Location: mypage.php?id=$id");
    exit();
    ?>



"mypage.php?id=<?php echo $id; ?>"