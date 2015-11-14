<html lang=zh-tw>
<head>
<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name=description content="">
<meta name=author content="">
<link rel=icon href=https://kkbruce.tw/Content/AssetsBS3/img/favicon.ico>
<title>搶捷</title>
<link href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css rel=stylesheet>
<link href=https://kkbruce.tw/Content/AssetsBS3/examples/starter-template.css rel=stylesheet> 
 <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js></script>
 <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js></script>
 <script src=https://kkbruce.tw/Scripts/AssetsBS3/ie10-viewport-bug-workaround.js></script>
<!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
<script src=https://kkbruce.tw/Scripts/AssetsBS3/ie-emulation-modes-warning.js></script> 
<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script>
<script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->


</head>
<body>
<?php
//include navigation bar php page
include_once "nav.php";
?>
 
 <div class=container>

   <div class = "row"></div>

 
  
 </div>
  <script>
$(document).ready(function(){

     
       
    });
		
</script>
<div class=container>
<div class = "row">
<?php
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

 $ProductID=$_GET['ProductID'];
 $sql = "SELECT * FROM Product,Store where Product.StoreID=Store.StoreID and ProductID='".$ProductID."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $Image_1="";
	$StartPrice=0;
	$ProductName="";
	$Amount=0;
	$ProductDesc="";
	$StoreName="";
	$StoreAddress="";
	$StorePhone="";
	// output data of each row
    while($row = $result->fetch_assoc()) {

	 $Image_1=$row["Image_1"];
	 $Image_2=$row["Image_2"];
	 $StartPrice=$row["StartPrice"];
	 $ProductID=$row["ProductID"];
	 $ProductName=$row["ProductName"];
	 $Amount=$row["Amount"];
	 $ProductDesc=$row["ProductDesc"];
	 $StoreName=$row["StoreName"];
	 $StoreAddress=$row["StoreAddress"];
	 $StorePhone=$row["StorePhone"];
    }
	echo "<div class='panel panel-info'>";
 echo "<div class='panel-heading'>";
 echo "<center><h3 class='panel-title'>商品介紹</h3></center>";
  echo "</div>";

   echo "<table>";
   echo "<tr>";
   echo "<th>";
    echo "<img src='".$Image_1."' alt='Smiley face' class='img-thumbnail'>";
   echo "</th>";
    echo "<th  style ='width:50%;'>";
  echo "<img src='".$Image_2."' alt='Smiley face' class='img-thumbnail'>";
   	 echo "</th>";
   echo "</tr>";
 
echo "</table>";
 echo "<hr>";
  //echo "<CENTER><h3>剩下".$Amount."個</h3></CENTER>";
echo "<font color='gray'>25人在降價,只剩1個</font>";	
	echo "<font color='orange'><h3>NT$".$StartPrice."</h3></font>";
 echo "<b>".$ProductName."</b>";
 
 


  echo "<h4> ".$ProductDesc."</h4>";
  echo "<hr>";
  echo "店家名稱:".$StoreName;
  echo "<br>";
  echo "店家地址:".$StoreAddress;

echo "<a href='tel:098-9980937'>&#9742;</a>";

  echo "</div>";
  

  	    echo "<a href='#' id=Buy_".$ProductID." class='btn btn-success btn-lg btn-block' data-toggle='modal' data-target='#PurchaseMethod'>立即購買</a>";
 
} else {
    echo "0 results";
}

$conn->close();
?>
</div>
</div>
 <script>
$(document).ready(function(){

    $("a").click(function(){
  //$("p").slideToggle();
       // alert(this.id);
		var ActionID=this.id;
		$("#ActionID").val(this.id);
		
		//alert(ActionID);
		//var str = "How are you doing today?";
		var ActionStr = ActionID.split("_");
		var Action=ActionStr[0];
		var ProductID=ActionStr[1];
		//alert(Action[0]);
		if(Action=="Get"){
			//alert(ActionStr);
			$("#Get_"+ProductID).css("display", "none");
			$("#More_"+ProductID).removeAttr("style");
		}
	});
	
	$(function(){
    $('#BuyProductForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "http://www.medeal.tk/process.php", //this is the submit URL
            type: 'GET', //or POST
            data: $('form.contact').serialize(),
            success: function(data){
                 alert('已購買完成,謝謝!!');
				 $("#PurchaseMethod").modal('hide'); 
            },
			error:function(data){
				alert('已購買完成,謝謝!!');
				 $("#PurchaseMethod").modal('hide'); 
            }
        });
    });
});
        
});
</script>
<?php
//include Login php page
include_once "Login.php";
//include purchase method php page
include_once "PurchaseMethod.php";
?>
</body>
</html>