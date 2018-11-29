<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
	<meta http-equiv="refresh" content="3; url=inserthouse.php">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
	 crossorigin="anonymous">

</head>

<body>
	<link rel="stylesheet" href="../style.css"><br>

	<?php

	if(move_uploaded_file($_FILES["image"]["tmp_name"],"pic/".$_FILES["image"]["name"]))
	{
		echo "<br>";
	}

$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
$objDB = mysql_select_db("landandhouse");
$strSQL = "INSERT INTO housland ( hlname, hlnohouse, hltype,hlrent, hlpic) 
		VALUES ('".$_POST["name"]."','".$_POST["hu"]."'
		,'".$_POST["type"]."','".$_POST["rent"]."','".$_FILES["image"]["name"]."')"; 

$objQuery = mysql_query($strSQL);
if($objQuery)
{?>

	<div class="container-fluid">
		<div class="card text-dark" style="background-color:#28a999">
			<div class="card-body text-center text-white">
				<h1>
					<?php echo "บันทึกข้อมูลสำเร็จ";
	}
	else
	{
	echo "มีข้อผิดพลาด [".$strSQL."]";
	} ?>
				</h1>
			</div>
		</div>
	</div>



	<?php 
mysql_close($objConnect);
?>
</body>

</html>