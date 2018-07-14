<?php 
  
  if(isset($_COOKIE['loggedIn']))
  {
    

    $user =  $_COOKIE['loggedIn'];
  
  }
  else
  {
  }


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

<h1 align="center">Simple Library</h1>
<div class="navbar">
  <a href="../index.php">HOME </a>
  <?php 
  if(isset($user))
  {
 	echo '  <a href="../borrowed.php?opt=2">Borrowed Books</a>
 	 <a href = "../borrowed.php?opt=4">History  </a>
  
  
 	 <a href="../logout.php" class="right">Logout &rarr; '. $user.'</a>';
 	 }
   else
   {
   		echo '<a href="signUp.php">Sign Up</a>';
   }
  ?>
    
</div>
<?php 
  if(!isset($user))
		{
		  		
		  
				echo '<h2 align="center">Please Login to Continue</h2>
				
				<div class="login_area">
			
					<form action="/login.php" method = POST>
					    <div class="form-group">
					      <label for="email">Email:</label>
					      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
					    </div>
					    <div class="form-group">
					      <label for="pwd">Password:</label>
					      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" maxlength=8>
					    </div>
					    <button type="submit" class="btn btn-default">Submit</button>
					    <input type = "reset" class = "btn btn-danger" value="Clear">
		  			</form>
		
				</div>';
	  
	  
	  }
  else
  {
    require_once("get_book_details.php");
    global $get_books_result;
    if($get_books_result)
		{
			echo '<table class="table table-striped" border=5>
			 <th>Book Title</th><th>Author</th><th>Edition</th><th>Borrow</th>';

		 while($row = $get_books_result->fetch_assoc())
		 	{	$book_id = $row['book_id'];
		 	 	echo '<tr><td>'.$row['book_name'].'</td><td>'.$row['book_author'].'</td><td>'.$row['Edition'].'</td><td><a href="../borrowed.php?opt=1&bookid='.$book_id.'&book_name='.$row['book_name'].'">Borrow</a></td></tr>';
		 	}
		 	echo '</table>';
		}
    
   
      
  
  }


 ?>
</body>
</html>