<?php 
	try {$db = new PDO ('mysql:dbname=boarddb; host=localhost', 'root', 'root'); 
	} catch (PDOexception $e) {
		echo $e -> getMessage();
	}	
?>

