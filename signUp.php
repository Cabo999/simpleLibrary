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

<h1 align="center">Sign Up for Simple Library</h1>
<div class="navbar">
  <a href="../index.php">HOME</a>
  </div>
  
  <div class="signup_area">
			
					<form action="" method = POST>
					    <div class="form-group">
					      <label for="email">Email:</label>
					      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
					    </div>
					    <div class="form-group">
					      <label for="Name">Full Name:</label>
					      <input type="text" class="form-control" id="name" placeholder="Enter Full Name" name="name" required>
					    </div>

					    <div class="form-group">
					      <label for="pwd">Password:</label>
					      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"required>
					    </div>
					    <button type="submit" class="btn btn-default">Submit</button>
					    <input type = "reset" class = "btn btn-danger" value="Clear">
		  			</form>
		
				</div>

  </body>
</html>

<?php
    
	require_once("connection.php");
	$date_time =  date("Y-M-D h:i:s");
	$name = $_POST['name'];
	$email_id = $_POST['email'];
	$passwd = $_POST['pwd'];
	
	if(isset($name))
	{ 
	
		$querry_signup = "INSERT INTO `user_credentials` (`id`, `email_id`,`user_name`, `password`, `date_time`) VALUES (NULL, '$email_id','$name' ,'$passwd', '$date_time')";
		global $conn;
		$result =  $conn->query($querry_signup);
		if($result)
			{
				$borrow_table_name = (string)$email_id."_borrowed";
			 	$querry_create_table = "CREATE TABLE IF NOT EXISTS `$borrow_table_name` (`book_id` VARCHAR(10) NOT NULL,`book_name` VARCHAR(30) ,`date_time` VARCHAR(30) ,`borrowed` VARCHAR(1)) ;";
			 	//echo $querry_create_table;
			 	$result_table =  $conn->query($querry_create_table);
			 	if($result_table)
			 	{
			 	 	echo "<h2>Signup Successfull click Home to go back to login page</h2>";
			 	 	sleep(1);
					echo '<script> window.location.assign("https://libsimple.000webhostapp.com/")</script>';

			 	}

				
			}

	}

?>