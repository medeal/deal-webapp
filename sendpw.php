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
//$sqlquery="Select * from Member where Email='".$_POST["inputEmail"]. " and Email='".$_POST["inputPassword"]."'";
//if ($conn->query($sql) === TRUE) {
$results=$conn->query("SELECT Password FROM Member WHERE Email='".$_GET["Email"]."'");
//mysql_select_db($dbname, $conn);
//$result = mysql_query("SELECT COUNT( 1 ) FROM Member WHERE Email ='".$_POST["inputEmail"]."'");
//$row = mysql_fetch_array($result);
//$total=0;
//while($row=$results->fetch_assoc()){
//	echo "run loop";
//	$total = $row[0];
//	echo "row:".$row[0];
//}

//if($total==1){
$Userpw="";
if($results->num_rows > 0) {
    echo "Send Password";
	while($row = $results->fetch_assoc()) {
        echo "Password: " . $row["Password"];
		$Userpw=$row["Password"];
    }
   //$_SESSION["UserEmail"]=$_POST["inputEmail"];
   
//需要get 啟動url
$Body="您的帳號密碼資訊如下:<br>";
$Body=$Body."帳號:".$_GET["Email"];
$Body=$Body."<br>";
$Body=$Body."密碼:".$Userpw;
//example to send mail:
//echo send_simple_message("lisivo@gmail.com","lisivo@gmail.com","test2","body test");
send_simple_message("admin@medeal.tk",$_GET["Email"],"搶捷帳號密碼通知信件",$Body);
}
$results->free();
$conn->close();
?>