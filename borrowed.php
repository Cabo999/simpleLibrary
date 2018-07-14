<?php  
	session_start();
	$opt = $_GET['opt'];
	?>
	
	   
	   
<!DOCTYPE html>
<html lang="en">
<head>
<title>Simple Library</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body {
	width:100%;	
	height:100%;
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
}



* {
    box-sizing: border-box;
}
#map {
        height: 400px;
      }


.header {
    padding: 80px;
    text-align: center;
    background: #1abc9c;
    color: white;
}


.header h1 {
    font-size: 40px;
}
.navbar {
    overflow: hidden;
    background-color: #333;
}


.navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}


.navbar a.right {
    float: right;
}


.navbar a:hover {
    background-color: #ddd;
    color: black;
}
.login_area {
	width:80%;
	margin-left:5%;
}
</style>
 
 
  
</head>
<body>

<h1 align="center">Borrowed Books</h1>
<div class="navbar">
  <a href="../index.php">HOME </a>
  <?php
  $user = $_COOKIE['loggedIn']; 
  if(isset($user))
  {
 	echo '  <a href="../borrowed.php?opt=2">Borrowed Books</a>
 	 <a href = "../borrowed.php?opt=4">History  </a>
  
  <a href="../logout.php" class="right">Logout &rarr; '. $user.'</a>';
   	 }
?>
</div>





<?php

	if(isset($_SESSION['user_id']))
	{
		require_once("connection.php");
		$user_id = $_SESSION['user_id'];
		$email_id = $_COOKIE['loggedIn'];
		$borrow_table_name = $email_id."_borrowed";
	    if($opt == 1)
	    {
	    	$book_id = $_GET['bookid'];
	    	$book_name = $_GET['book_name'];
	    	$date_time = date("y-m-d h:i:s A");
	    	borrow($book_id,$borrow_table_name,$book_name,$date_time);
	    }
	}	
		if($opt == 2)
	    {
	    	show_borrowed($borrow_table_name);
	    }
	    if($opt == 3)
	    {
	    	$book_return = $_GET['book_name'];
	    	$date = $_GET['date_time'];
	    	return_book($borrow_table_name,$book_return,$date);	    
	    }
	    if($opt == 4)
	    {
	    	show_all_books_history($borrow_table_name);
	    }
	    
	    
	 
	 function return_book($borrow_table_name,$book_return,$date)
	 {
	 	global $conn;
	 	$querry_return =  "UPDATE `$borrow_table_name` SET `borrowed`='0' WHERE `book_name`='$book_return' AND `date_time`='$date'";
	 	$return_result = $conn->query($querry_return);
	 	if($return_result)
	 	{
	 		show_borrowed($borrow_table_name);
	 	}
	 }
	function borrow($book_id,$borrow_table_name,$book_name,$date_time)
	{	
		global $conn;
		
		$querry_borrow = "INSERT INTO `$borrow_table_name` (`book_id`, `book_name`, `date_time`,`borrowed`) VALUES ('$book_id', '$book_name', '$date_time','1')";
		//echo $querry_borrow;
		$borrow_result = $conn->query($querry_borrow);
		if($borrow_result)
			{
				echo '<script> window.location.assign("https://libsimple.000webhostapp.com/borrowed.php?opt=2")</script>';
			}
	
	}
	function show_all_books_history($borrow_table_name)
	{
		global $conn;
		$querry_show_history = "select * from `$borrow_table_name`";
		$show_history_result = $conn->query($querry_show_history);
		if($show_history_result)
		{
			 $count = 0;
			 echo '<table class="table table-striped" border=5>
			 <th>Book Title</th><th>Date and Time</th><th>status</th>';	
			 while($row = $show_history_result->fetch_assoc())
			 {
			 	$count +=1;
			 	if($row['borrowed']=="1")
			 	{
			 	 	$action = "Borrowed";
			 	 
			 	}
			 	else
			 	{
			 		$action = "returned";
			 	}
			 	echo "<tr><td>".$row['book_name']."</td><td>".$row['date_time']."</td><td>".$action."</td></tr>";
			 }
			 echo "</table>";
			 if($count == 0 )
			 {
			   echo "<h2> No books borrowed or returned untill now.Go to Home page to borrow books</h2>";
			 }
		}
	}
	function show_borrowed($borrow_table_name)
	{
		global $conn;
		$querry_show_borrow = "select * from `$borrow_table_name` where borrowed=1";
		//echo $querry_show_borrow;
		$show_borrow_result = $conn->query($querry_show_borrow);
		if($show_borrow_result)
		{
			$count = 0;
		echo '<table class="table table-striped" border=5>
			 <th>Book Title</th><th>Date and Time</th><th>Action</th>';
			 
				while($row = $show_borrow_result->fetch_assoc())
					{
						$count +=1;
						echo "<tr><td>".$row['book_name']."</td><td>".$row['date_time']."</td><td><a href='../borrowed.php?opt=3&book_name=".$row['book_name']."&date_time=".$row['date_time']."'>Return</a></td></tr>";
					}
			 echo "</table>";
			 if($count == 0)
			 {
			 	echo "<h2>There are no borrowed books for your account click on Home to browse and borrow books</h2>";
			 }
		}
		
	}



?>
</body>
</html>