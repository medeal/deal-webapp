<html lang=zh-tw>
<head>

<?php
session_start();
//$ProductID=$_SESSION["ProductID"];
//echo $ProductID;
?>
<?php
//echo "http://www.facebook.com/sharer.php?u=http://www.medeal.tk/ProductDetail.php?ProductID=".$_SESSION["ProductID"];
?>
</head>
<body>
<!--<a href="http://line.naver.jp/R/msg/text/?哈囉,我想買這個商品,請幫我取得優惠,謝謝!!%0D%0Ahttp://www.medeal.tk/product.php">-->
<a href=<?php 
echo "http://line.naver.jp/R/msg/text/?哈囉,我想買這個商品,請幫我砍價,謝謝!!%0D%0Ahttp://www.medeal.tk/ProductDetail.php?ProductID=".$_SESSION["ProductID"];
?>
>
<img src="http://www.medeal.tk/linebutton_84x20_zh-hant.png"></a>
<!--<a href="http://www.facebook.com/sharer.php?u=http://www.medeal.tk/ProductDetail.php?ProductID= target="_blank">-->
<br>
<a href=<?php
echo "http://www.facebook.com/sharer.php?u=http://www.medeal.tk/ProductDetail.php?ProductID=".$_SESSION["ProductID"];
?> target="_blank">
  
 <img src="http://www.medeal.tk/fb.png" alt="Facebook" height="60" width="150" />
</body>