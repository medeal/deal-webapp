<?php


$UserEmail=$_GET["Email"];
//echo $_GET["inputPassword"];

//需要將帳號資料insert到memeber table
$DBconfig=parse_ini_file("DBconfig.ini");
$servername = $DBconfig['servername'];
$username = $DBconfig['username'];
$password = $DBconfig['password'];
$dbname =$DBconfig['dbname'];
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "Update Member set Status='Y' Where Email='".$UserEmail."'";

if ($conn->query($sql) === TRUE) {
     echo "OK";
} else {
     echo "NO";
}


?>