<?php
session_start();
 $_SESSION["UserEmail"]="";
$UserEmail = $_SESSION["UserEmail"];
if($UserEmail == '')
{
	//session expired
	echo "1";
} else {
	//session not expired
    echo "0";
}
?>