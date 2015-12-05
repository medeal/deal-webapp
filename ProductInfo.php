<html lang=zh-tw>
<head>
<script>
function fb_share_click(){
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54131922-2', 'auto');
  ga('send','event', {
  'eventCategory': 'FB',
  'eventAction': 'Share to kill price'});
}

function line_share_click(){
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54131922-2', 'auto');
  ga('send','event', {
  'eventCategory': 'Line',
  'eventAction': 'Share to kill price'});

}


</script>
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
<a id='line_share' onclick="line_share_click()"  href=<?php 
echo "http://line.naver.jp/R/msg/text/?哈囉,我想買這個商品,請幫我砍價,謝謝!!%0D%0Ahttp://www.medeal.tk/ProductDetail.php?ProductID=".$_SESSION["ProductID"];
?>
>
<img src="http://www.medeal.tk/linebutton_84x20_zh-hant.png"></a>
<!--<a href="http://www.facebook.com/sharer.php?u=http://www.medeal.tk/ProductDetail.php?ProductID= target="_blank">-->
<br>
<a id='fb_share' onclick="fb_share_click()" href=<?php
echo "http://www.facebook.com/sharer.php?u=http://www.medeal.tk/ProductDetail.php?ProductID=".$_SESSION["ProductID"];
?> target="_blank">
  
 <img src="http://www.medeal.tk/fb.png" alt="Facebook" height="60" width="150" />
</body>