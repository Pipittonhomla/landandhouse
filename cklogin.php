<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("landandhouse");



	$strSQL = "SELECT * FROM customer WHERE cususer = '".mysql_real_escape_string($_POST['cususer'])."' 
	and cuspassword = '".mysql_real_escape_string($_POST['cuspassword'])."'  ";

	
// $strSQL = "SELECT cususer, cuspassword 
//     FROM customer 
//     WHERE cususer='".mysql_real_escape_string($_POST['cususer'])."' AND cuspassword='".mysql_real_escape_string($_POST['cuspassword'])."' 
//     UNION 
//     SELECT empuser, emppassword 
//     FROM employee 
// 		WHERE empuser='".mysql_real_escape_string($_POST['cususer'])."' AND emppassword='".mysql_real_escape_string($_POST['cuspassword'])."'";
		
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);



	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["cususer"] = $objResult["cususer"];
			$_SESSION["cuspassword"] = $objResult["cuspassword"];

			session_write_close();
			
			if($objResult)
			{
				header("location:home.php");
			}
	
	}
	mysql_close();
?>