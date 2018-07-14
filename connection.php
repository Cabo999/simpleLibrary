<?php 
error_reporting(0);
$servername = "localhost";
$username = "id6483425_admin_jeet";
$password = "satyatheking";
$dbname = "id6483425_main";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




?>