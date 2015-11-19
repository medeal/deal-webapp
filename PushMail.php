<?php

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

//echo "show somthing below:";
//echo $_GET["inputEmail"];
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

$sql = "INSERT INTO Member(Email,Password,Status) VALUES('".$_POST["inputEmail"]."','".$_POST["inputPassword"]."','N')";

if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

//需要get 啟動url
$Body="請點擊以下連結,立即啟動您的帳號:<br>";
$Body=$Body."<a href='http://www.medeal.tk/UserValidation.php?Email=".$_POST["inputEmail"]."' target='_blank' title='啟動帳號'>點擊啟動您的帳號</a>";
$Body=$Body."<br>";
$Body=$Body."<a href='http://www.medeal.tk/ProductDetail.php?ProductID=A002' target='_blank' title='商品連結'>搶購商品連結</a>";
//example to send mail:
//echo send_simple_message("lisivo@gmail.com","lisivo@gmail.com","test2","body test");
send_simple_message("admin@medeal.tk",$_POST["inputEmail"],"搶捷帳號驗證啟動信",$Body);
?>