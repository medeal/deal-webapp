<html lang=zh-tw>
<?php    
if(isset($_POST['btnContactOK'])){ //check if form was submitted
$Email = $_POST['Email']; //get input text
$Question =  $_POST['Question']; //get input text
echo "<script>alert('OK,thank you!!');</script>";


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

$sql = "INSERT INTO Contact(Email,Question,CreateDate) VALUES('".$Email."' ,'".$Question."',now())";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	//header("Location: http://www.medeal.tk/product.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo  "<script>window.history.back();</script>";
}    
?>
<div id="Contact" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
	
      <form class="Contact1" id="Contact1" action="Contact.php" method="POST">
	  <h3>您的寶貴意見是我們進步的動力,請留下以下資訊,我們會盡快跟您聯繫,謝謝</h3>

	Email: <input type="text" name="Email" id="Email"> </br>
問題描述: <textarea rows="4" cols="50" name="Question" id="Question"> </textarea></br>
</br></br>
<button class="btn btn-lg btn-success btn-block" type=submit id="btnContactOK" name="btnContactOK">確定</button>

</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" name="btnClose" id="btnClose">Close</button>
      </div>
    </div>

  </div>
</div>
</html>