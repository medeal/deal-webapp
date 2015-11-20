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
<!--<link href='../css/bootstrap.min.css' rel=stylesheet>-->
<link href=https://kkbruce.tw/Content/AssetsBS3/examples/starter-template.css rel=stylesheet> 
 <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js></script>
 <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js></script>
 <script src=https://kkbruce.tw/Scripts/AssetsBS3/ie10-viewport-bug-workaround.js></script>
<!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
<script src=https://kkbruce.tw/Scripts/AssetsBS3/ie-emulation-modes-warning.js></script> 
<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script>
<script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->

<style>
hr{
      display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
	
}
</style>

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
session_start();
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
 $sql2="SELECT IFNULL( SUM( TakeFavorPrice ) , 0 ) AS TotalFavorPrice FROM MemberFavor where ProductID='".$ProductID."'";


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
	$FavorPrice=0;
	$TotalFavorPrice=0;
	// output data of each row
    while($row = $result->fetch_assoc()) {

	 $Image_1=$row["Image_1"];
	 $Image_2=$row["Image_2"];
	 $StartPrice=$row["StartPrice"];
	 $CurrentPrice=$row["CurrentPrice"];
	 $ProductID=$row["ProductID"];
	 $ProductName=$row["ProductName"];
	 $Amount=$row["Amount"];
	 $ProductDesc=$row["ProductDesc"];
	 $StoreName=$row["StoreName"];
	 $StoreAddress=$row["StoreAddress"];
	 $StorePhone=$row["StorePhone"];
    }
	
	$result2 = $conn->query($sql2);
	while($row = $result2->fetch_assoc()) {
		$TotalFavorPrice=$row["TotalFavorPrice"];
	}
	$FavorPrice=$StartPrice-$TotalFavorPrice;
	
	echo "<div class='panel panel-primary'>";
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
	echo "<font color='orange'><h3>NT$".$FavorPrice."</h3></font>";
 echo "<b>".$ProductName."</b>";
 
 


  echo "<h4> ".$ProductDesc."</h4>";
  echo "<hr>";
  echo "店家名稱:".$StoreName;
  echo "<br>";
  echo "店家地址:".$StoreAddress;

echo "<a href='tel:098-9980937'>&#9742;</a>";


  
	echo "<a href='#' id=Get_".$ProductID." class='btn btn-warning btn-lg btn-block'>砍價!</a>";
		echo "<a href='#' id=More_".$ProductID." class='btn btn-danger btn-lg btn-block' data-toggle='modal' data-target='#MorePromotions' style='display:none;' >砍更多價!!</a>";
  	    echo "<a href='#' id=Buy_".$ProductID." class='btn btn-success btn-lg btn-block' data-toggle='modal' data-target='#PurchaseMethod'>立即購買</a>";
	
		 
		 echo "</div>";
 
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
	//alert(this.id);
	var Action=this.id;
	if(Action=="forgetpw"){
	//alert($("#inputEmail").val());
	var postURL;
	postURL="sendpw.php?Email="+$("#inputEmail").val();
	var str="chklogout=true";
	jQuery.ajax({
				type: "POST",
				url: postURL,
				data: str,
				cache: false,
				async: false, 
				success: function(res){
					
						alert("已發送密碼至您Email!");
					
				}
		});
		//alert("已發送密碼至您Email!");
		return false;
	}
	
	var check_session;
	function CheckForSession() {
		var str="chklogout=true";
		jQuery.ajax({
				type: "POST",
				url: "chk_session.php",
				data: str,
				cache: false,
				async: false, 
				success: function(res){
					if(res == "1") {
						alert('請註冊或登入帳號');
						$('#Login').modal('show');
						check_session='1';
					}
					
					
				}
		});
		return check_session;
	}
//check_session = setInterval(CheckForSession, 5000);

	check_session =CheckForSession();
	//alert(check_session);
	if(check_session=="1"){
		return false;
	}
	
	
  //$("p").slideToggle();
       // alert(this.id);
		var ActionID=this.id;
		$("#ActionID").val(this.id);
		
		//alert(ActionID);
		//var str = "How are you doing today?";
		var ActionStr = ActionID.split("_");
		var Action=ActionStr[0];
		var ProductID=ActionStr[1];
		//var UserEmail='<?php echo $_SESSION["UserEmail"]; ?>';
		//alert('<?php echo $_SESSION["UserEmail"]; ?>');
		//alert(UserEmail);
				
		//alert(Action[0]);
		if(Action=="Get"){
			//alert(ActionStr);
			$("#Get_"+ProductID).css("display", "none");
		
				var postURL;
				postURL="GetFavor.php?ProductID="+ProductID;
				var str="chklogout=true";
				jQuery.ajax({
				type: "POST",
				url: postURL,
				data: str,
				cache: false,
				async: false, 
				success: function(res){		
						alert("已取得優惠!");
					}
				});
				
			
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
    $("#RegisterLogin").click('submit', function(e){
		 e.preventDefault();
		$.ajax({
            url: "http://www.medeal.tk/PushMail.php", //this is the submit URL
            type: 'POST', //or POST
            data: $('form.form-signin').serialize(),
			async: false, 
            success: function(data){
                
				if(data == "Login") {
				 alert('已登入!!');
				}
				if(data == "Register") {
				 alert('已註冊完成,請至Email收信啟動帳戶,謝謝!!');
				}
				 $("#Login").modal('hide'); 
            },
			error:function(data){
				alert('系統錯誤!!');
				 $("#Login").modal('hide'); 
            }
        });
		
	})     
});
</script>
<?php
//include Login php page
include_once "Login.php";
//include purchase method php page
include_once "PurchaseMethod.php";
//include mailgun mail php page
include_once "mailgun.php";
?>
</body>
</html>