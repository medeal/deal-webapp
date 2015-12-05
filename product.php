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

   <div class = "row-fluid"></div>
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
 $sql = "SELECT * FROM Product,Store where Product.Open='Y' and Product.StoreID=Store.StoreID";

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
		$ProductName=$row["ProductName"];
		$Image_1=$row["Image_1"];
		$StartPrice=$row["StartPrice"];
		$CurrentPrice=$row["CurrentPrice"];
		$StoreName=$row["StoreName"];
		$ProductID=$row["ProductID"];
		$Amount=$row["Amount"];
//echo $ProductName;
		echo "<div class = 'col-md-6'  style = 'box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;'>";
		echo "<table>";
		echo "<tr>";
		echo "<th>";
		echo "<br>";
		echo "<img src='".$Image_1."' alt='Smiley face' class='img-thumbnail'>";
		echo "</th>";
		echo "<br>";
		echo "<th  style ='width:50%;'>";
	    echo "<CENTER><p>商品名稱:".$ProductName."</p></CENTER>";
		echo "<CENTER><p>售價:<del>$".$StartPrice."</del></p><p>搶購中:$".$CurrentPrice."</p></CENTER>";
		echo "<CENTER><p>".$StoreName."</p></CENTER>";
		echo "<CENTER><p></p></CENTER>";
	   // echo "<a href='#' id=Buy_".$ProductID." class='btn btn-success btn-lg btn-block' data-toggle='modal' data-target='#PurchaseMethod'>立即購買</a>";
		echo "<a href='http://www.medeal.tk/ProductDetail.php?ProductID=".$ProductID."' class='btn btn-primary btn-lg btn-block'>詳細</a>";
		//echo "<a href='#' id=Get_".$ProductID." class='btn btn-warning btn-lg btn-block'>取得優惠</a>";
		//echo "<a href='#' id=More_".$ProductID." class='btn btn-danger btn-lg btn-block' data-toggle='modal' data-target='#MorePromotions' style='display:none;' >取得更多優惠!</a>";
		if($Amount==0){
			echo "<a href='#' id=RunOut_".$ProductID." class='btn btn-default btn-lg btn-block'>已搶完</a>";
		};
		echo "<br>";
		echo "</th>";
		echo "</tr>"; 
		echo "</table>";
		echo "<br>";
		echo "</div>";
    }
 ?>
  
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
//include More Promotions php page
include_once "MorePromotions.php";

include_once "Contact.php";
include_once "Rule.php";
?>


</body>
</html>