<?php
$servername = "localhost";
$username = "root";
$password = "####";
$dbname = "projectdb1";

//Create conn
$conn = new mysqli($servername, $username, $password, $dbname);

//Check conn
if ($conn->connect_error)
{
	die("Connection failed: " .$conn->connect_error);
}
?>
