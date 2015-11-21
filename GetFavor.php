<?php
session_start();
$UserEmail=$_SESSION["UserEmail"];
$ProductID=$_GET["ProductID"];
$FavorablePrice=0;
$TotalFavorPrice=0;
$StartPrice=0;
$EndPrice=0;
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
//在取得優惠時,檢查現在是否已在底價,如在底價就不優惠
$results1=$conn->query("SELECT IFNULL( SUM( TakeFavorPrice ) , 0 ) AS TotalFavorPrice FROM MemberFavor where ProductID='".$ProductID."'");
 if($results1->num_rows > 0) {
		echo "Check End Price";
		while($row = $results1->fetch_assoc()) {
			echo "TotalFavorPrice: " . $row["TotalFavorPrice"];
			$TotalFavorPrice=$row["TotalFavorPrice"];
		}
 }
 
 
//Need to do!!
//檢查是否以經有優惠過了嗎?
//$results=$conn->query("SELECT * FROM Member WHERE Email='".$_POST["inputEmail"]."' and Password='".$_POST["inputPassword"]."'");
//取得每次砍價的幅度
$results2=$conn->query("SELECT StartPrice,EndPrice,FavorablePrice FROM Product WHERE ProductID='".$ProductID."'");
   if($results2->num_rows > 0) {
		echo "Get Product Favor Price";
		while($row = $results2->fetch_assoc()) {
			echo "ProductFavorPrice: " . $row["FavorablePrice"];
			$FavorablePrice=$row["FavorablePrice"];
			$StartPrice=$row["StartPrice"];
			$EndPrice=$row["EndPrice"];
		}
	}
	//在取得優惠時,檢查現在是否已在底價,如在底價就不優惠
	echo "<br>";
	echo "EndPrice:".$EndPrice;
	echo "<br>";
	echo "StartPrice:".$StartPrice;
	echo "<br>";
	echo "TotalFavorPrice:".$TotalFavorPrice;
	if($EndPrice<($StartPrice-$TotalFavorPrice)){
	
   $sql = "INSERT INTO MemberFavor(Email,ProductID,TakeFavorPrice,TakeFavorDate) VALUES('".$UserEmail."','".$ProductID."',".$FavorablePrice.",NOW())";
if ($conn->query($sql) === TRUE) {
}
else{
}
//$results->free();
}
$results1->free();
$results2->free();

$conn->close();
?>