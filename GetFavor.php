<?php
session_start();
$UserEmail=$_SESSION["UserEmail"];
$ProductID=$_GET["ProductID"];
$FavorablePrice=0;
echo $UserEmail;
echo $ProductID;
$DBconfig=parse_ini_file("DBconfig.ini");
$servername = $DBconfig['servername'];
$username = $DBconfig['username'];
$password = $DBconfig['password'];
$dbname =$DBconfig['dbname'];
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//檢查是否以經有優惠過了嗎?
//$results=$conn->query("SELECT * FROM Member WHERE Email='".$_POST["inputEmail"]."' and Password='".$_POST["inputPassword"]."'");
//取得每次砍價的幅度
$results2=$conn->query("SELECT FavorablePrice FROM Product WHERE ProductID='".$ProductID."'");
   if($results2->num_rows > 0) {
		echo "Get Product Favor Price";
		while($row = $results2->fetch_assoc()) {
			echo "ProductFavorPrice: " . $row["FavorablePrice"];
			$FavorablePrice=$row["FavorablePrice"];
		}
	}
   $sql = "INSERT INTO MemberFavor(Email,ProductID,TakeFavorPrice,TakeFavorDate) VALUES('".$UserEmail."','".$ProductID."',".$FavorablePrice.",NOW())";
if ($conn->query($sql) === TRUE) {
}
else{
}
//$results->free();
$conn->close();
?>