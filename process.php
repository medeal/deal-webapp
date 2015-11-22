<?php 
session_start();
function send_simple_message($from,$to,$subject,$body){  
  $ch = curl_init();
  //from:who sent the mail
			  //to:sent mail to who
			  //subject:mail subject
			  //hmtl:mail body
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:key-965d3a2fd273c7c7d038c54f728ca93a');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, 
              'https://api.mailgun.net/v3/sandbox4aad892302324b3d96425e04cc06a2b6.mailgun.org/messages');
  curl_setopt($ch, CURLOPT_POSTFIELDS, 
                array('from' => $from,
                      'to' => $to,
                      'subject' => $subject,
                      'html' => $body));
  $result = curl_exec($ch);
  curl_close($ch);
  //return $result;
}


//echo $_POST['ActionID']; echo "show something"; 
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
//$_POST["inputEmail"]
$ProductID = explode("_", $_POST['ActionID']);
//echo $pieces[0]; // piece1
//echo $pieces[1]; // piece2
$PurchasePrice=$_POST['txtPurchasePrice'];
$sql = "INSERT INTO ecOrder(ProductID,OrderDateTime,Email,IsPaid,PurchasePrice) VALUES('".$ProductID[1]."',now(),'".$_SESSION["UserEmail"]."','N',".$PurchasePrice.")";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
//UPDATE my_table SET my_field = my_field - 1 WHERE `other` = '123'
$sql2="UPDATE Product SET Amount=Amount-1 WHERE ProductID='".$ProductID[1]."'";	
if ($conn->query($sql2) === TRUE){
echo "update record successfully";
}
else{
}
$Body="您已成功購買商品,商品資訊如下:<br>";
$Body=$Body."商品名稱:".$_POST['txtProductName'];
$Body=$Body."<br>";
$Body=$Body."購入價格:NT$".$PurchasePrice;
$Body=$Body."<br>";
$Body=$Body."購買數量:1";
$Body=$Body."<br>";

//example to send mail:
//echo send_simple_message("lisivo@gmail.com","lisivo@gmail.com","test2","body test");
send_simple_message("admin@medeal.tk",$_SESSION["UserEmail"].";lisivo@gmail.com","搶捷購買成功通知",$Body);
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>