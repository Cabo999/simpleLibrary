<?php  

session_start();
$email = $_POST['email'];
$passwd = $_POST['pwd'];
if($email != "" && $email != " ")

{
	
	
	$loggedIn = "loggedIn";
	$cvalue = $email;
	
	require_once("connection.php");
    match_credentials();

}
else
{
	die("Wrong Credentials Please Try Again");
}

function match_credentials()
{
	global $conn,$email,$passwd,$loggedIn,$cvalue;
	$count = 0;
	$querry_get_details = "Select * from user_credentials where email_id=\"$email\" and password =\"$passwd\"";
	
	$result =  $conn->query($querry_get_details);
	if($result)
	{
		
			while($row = $result->fetch_assoc())
			{
			
				$count += 1; 
				$user_id = $row['id'];
				$_SESSION['user_id']  = $user_id;				
			}
			if($count ==0)
				{
				
					echo "<h1>please signup to continue</h1><br>Redirecting to Home page in 3 seconds";
					flush();
					sleep(3);
					echo '<script> window.location.assign("https://libsimple.000webhostapp.com/")</script>';

				}
			else
			{
			setcookie($loggedIn,$cvalue,time()+86400*30,"/","",true);
			
			flush();
			sleep(1);
			echo '<script> window.location.assign("https://libsimple.000webhostapp.com/")</script>';
			
			}
	}
	else
		{
			die("No such records please check email and password again");
		}

}



?>
