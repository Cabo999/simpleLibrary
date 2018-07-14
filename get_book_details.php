
<?php
	require_once("connection.php");
	
	global $conn;
	$querry_get_books = "SELECT * FROM `books_database";
    $get_books_result =  $conn->query($querry_get_books);
	
	
	
	
	
?>

