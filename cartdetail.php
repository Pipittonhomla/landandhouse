<?php
	include("Connections/db.php");
	include("Connections/functions.php");
	
	if(isset($_REQUEST['command'])=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if(isset($_REQUEST['command'])=='clear'){
		unset($_SESSION['cart']);
	}
	else if(isset($_REQUEST['command'])=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['hlid'];
			$q=intval($_REQUEST['housland'.$pid]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}
	// session_start();
	if($_SESSION['cususer'] == ""  )
	{
		echo "Please Login!";
		exit();
	}


	
	mysql_connect("localhost","root","");
	mysql_select_db("landandhouse");
	$strSQL = "SELECT * FROM customer WHERE cususer = '".$_SESSION['cususer']."' ";
	$objQuery = mysql_query($strSQL);
    $objResult = mysql_fetch_array($objQuery);

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>บันทึกการจอง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <style>
        .noform {
	display: block;
    width: 100%;
    
    margin-top: -7px;
	height: calc(2.25rem + 2px);
	padding: .375rem .75rem;
	font-size: 1rem;
	line-height: 1.5;
	color: black;
	background-color: transparent;
	background-clip: padding-box;
	border: none;
	border-radius: .25rem;
	transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.noform2 {
    display: block;
    margin-left: 20px;
    width: 43px;
    /* margin-top: -7px; */
    height: calc(2.25rem + 2px);
    /* padding: .375rem .75rem; */
    font-size: 1rem;
    line-height: 1.5;
    color: black;
    background-color: transparent;
    background-clip: padding-box;
    border: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>
</head>

<body>
    <?php require_once("navbar1.php");?>
    <link rel="stylesheet" href="style.css"><br>

    <div class="container-fluid">
        <div class="card bg-basic text-dark">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center text-white" bgcolor="#28a999">
                        <th colspan="7">
                            <b>
                                <h1>บันทึกการจอง</h1>
                            </b>
                        </th>
                    </tr>

                    <tr>
                        <form name="frmSearch " method="post" action="insertrental.php">
                            <th colspan="7" style="background-color:#b6ece6">
                                <div class="row">
                                    <div class="col-2 text-right"><b>รหัสสมาชิก</b></div>
                                    <div class="col-2 text-center">
                                        <input type="text" class="noform" value="<?php echo $objResult["cusid"];?>" id="cusid" name="cusid" placeholder="<?php echo $objResult["cusidcard"];?>
                                        "  >
                                    </div>
                                    <div class="col-1 text-right"><b>ชื่อ</b></div>
                                    <div class="col-3 text-center">
                                        <input type="text" class="noform" id="cusname" name="cusname" placeholder="<?php echo $objResult["cusname"];?>
                                        " disabled >
                                    </div>
                                    <div class="col-2 text-right"><b>เบอร์โทรศัพท์</b></div>
                                    <div class="col-2 text-center">
                                        <input type="text" class="noform" id="custel" name="custel" placeholder="<?php echo $objResult["custel"];?>
                                        " >
                                    </div>
                                </div>
                            </th>
                    </tr>
                </thead>
                <thead>
                    <tr class="text-secondary">
                        <td><b>ชื่อบ้าน-ที่ดิน</b></td>
                        <td><b>หน่วยนับ</b></td>
                        <td><b>มัดจำ(บาท)</b></td>
                        <td><b>จำนวน</b></td>
                        <td><b>รวมราคา(บาท)</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
			if(is_array($_SESSION['cart'])){
            	
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['hlid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>
                    <tr class="text-secondary">

                    
                        <td>
                            <input type="text" class="noform2" id="hlname" name="hlname" placeholder="<?php echo $pname;?>
">
                        </td>
                        <td>
                            <input type="text" class="noform2" id="hltype" name="hltype" value="<?php echo get_type($pid);?>" placeholder="<?php echo get_type($pid);?>
">
                        </td>
                        <td>5000</td>
                        <td>
                            <input type="text" class="noform2" id="hlq" name="hlq" placeholder="<?php echo $q;?>
">

                        </td>
                        <td>
                            <input type="text" class="noform2" id="hlprice" name="hlprice" placeholder="<?php echo get_price($pid);?>
">

                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php					
				}
            ?>


                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-3 text-right p-2">
                วันกำหนดเข้าพัก
            </div>
            <div class="col-2">
                <input type="date" name="daterental" id="daterental" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button type="register" class="btn btn-success">บันทึก</button> &nbsp;&nbsp;
            <button type="register" class="btn btn-danger">ล้างค่า</button> &nbsp;&nbsp;
            <a href="../หน้าหลัก.html" class="btn btn-warning" role="button">กลับ</a>
        </div>
    </div>
    <?php
            }
			else{
				echo "There are no items in your shopping cart!";
			}
		?>
        </form>
    <br>
</body>

</html>