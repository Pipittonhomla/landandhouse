<?php require_once('Connections/landandhouse.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO customer (cusid, cususer, cuspassword, cusname, custel, cusaddress, cusidcard, cusemail, cusstatus) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cusid'], "int"),
                       GetSQLValueString($_POST['cususer'], "text"),
                       GetSQLValueString($_POST['cuspassword'], "text"),
                       GetSQLValueString($_POST['cusname'], "text"),
                       GetSQLValueString($_POST['custel'], "text"),
                       GetSQLValueString($_POST['cusaddress'], "text"),
                       GetSQLValueString($_POST['cusidcard'], "text"),
                       GetSQLValueString($_POST['cusemail'], "text"),
                       GetSQLValueString($_POST['cusstatus'], "int"));

  mysql_select_db($database_landandhouse, $landandhouse);
  $Result1 = mysql_query($insertSQL, $landandhouse) or die(mysql_error());

  $insertGoTo = "insertcustomer.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_landandhouse, $landandhouse);
$query_customer = "SELECT * FROM customer";
$customer = mysql_query($query_customer, $landandhouse) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <!--copyทั้งหมดในส่วนของheadเป็นscriptสำหรับทำช่องต่าง+ตกแต่ง-->
    <title>สมัครสมาชิก</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
<script>

    function checkidcard(cusidcard,limit)
    {
        if(cusidcard.value.length >= limit) //ค่า.ความยาว
        return false; //ให้หยุดการทำงาน
        if (event.keyCode >= 48 && event.keyCode <= 57) { 
                event.returnValue = true;
            } else {
                event.returnValue = false;
            }
    }
    function checktel()
    {
        if (event.keyCode >= 48 && event.keyCode <= 57) { 
                event.returnValue = true;
            } else {
                event.returnValue = false;
            }
    }
    function fncSubmit()
{
	if(document.form1.cususer.value == "")
	{
		alert('โปรดกรอกชื่อผู้ใช้');
		document.form1.cususer.focus();
		return false;
	}	

	if(document.form1.cuspassword.value == "")
	{
		alert('โปรดกรอกรหัสผ่าน');
		document.form1.cuspassword.focus();		
		return false;
	}	

	if(document.form1.cusrepassword.value == "")
	{
		alert('โปรดกรอกรหัสผ่านในช่องยืนยันรหัสผ่าน');
		document.form1.cusrepassword.focus();		
		return false;
	}	

	if(document.form1.cuspassword.value != document.form1.cusrepassword.value)
	{
		alert('รหัสผ่านไม่ตรงกัน');
		document.form1.cusrepassword.focus();		
		return false;
	}	

	document.form1.submit();
}
</script>

<body>
<?php require_once("navbar1.php");?>

    <link rel="stylesheet" href="style.css"><br>
    <div class="container-fluid">
        <!--ทำให้หน้าเว็บเว้นขอบข้างๆ-->
        <div class="card text-dark" style="background-color:#28a999">
            <!--การ์ด-->
            <div class="card-body text-center text-white">
                <!--การ์ด-->
                <h1> สมัครสมาชิก </h1>
            </div>
        </div><br>
        <!--ปิดการ์ด เมื่อปิดต้องปิดทุกครั้ง-->

        <div class="card text-white" style="background-color:#069">
            <!--แสดงผลเป็นการด์สีดำ-->
            <div class="card-body">
                ข้อมูลทั่วไป
            </div>
        </div><br>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>" OnSubmit="return fncSubmit();">
            <div class="card bg-basic text-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            หมายเลขบัตรประชาชน :
                        </div>
                        <div class="col-md-10 form-inline">
                            
                            <span id="sprytextfield1">
                            <label for=""></label>
                            <input name="cusidcard" type="text" class="form-control" id="cusidcard"
                                style="width:95%" size="32"  maxlength="13">
                            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinValueMsg">โปรดใส่เลขบัตรประชาชนให้ถูกต้อง</span><span class="textfieldMaxValueMsg">* (13 ตัวอักษร) </span></span>&nbsp;&nbsp; *
                            (13 ตัวอักษร)
                            <!--ช่องใส่ข้อมูล-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            ชื่อ - นามสกุล :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="text" name="cusname" value="" size="32" class="form-control" style="width:30%">
                            &nbsp;&nbsp; *
                            <!--ช่องใส่ข้อมูล-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            ที่อยู่ :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="text" name="cusaddress" value="" size="32" class="form-control" style="width:30%">
                            &nbsp;&nbsp; *
                            <!--ช่องใส่ข้อมูล-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            เบอร์โทรศัพท์ :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="text" name="custel" value="" size="32" class="form-control" style="width:30%" onkeypress="checktel()">
                            &nbsp;&nbsp; * (อย่างน้อย 9 ตัวอักษร)
                            <!--ช่องใส่ข้อมูล-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            อีเมล :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="text" name="cusemail" value="" size="32" class="form-control" style="width:30%">
                            &nbsp;&nbsp; *
                            <!--ช่องใส่ข้อมูล-->
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="card text-white" style="background-color:#069">
                <!--แสดงผลเป็นการด์ขาวๆ-->
                <div class="card-body">
                    ข้อมูลสำหรับเข้าสู่ระบบ
                </div>
            </div><br>

            <div class="card bg-basic text-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            ชื่อผู้ใช้ :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="text" name="cususer" id="cususer" value="" size="32" class="form-control" style="width:30%">&nbsp;&nbsp;
                            *
                            <!--ช่องใส่ข้อความ-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            รหัสผ่าน :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="password" name="cuspassword" id="cuspassword" value="" size="32" class="form-control" style="width:30%">
                            &nbsp;&nbsp; * (อย่างน้อย 8 ตัวอักษร)
                            <!--ช่องใส่ข้อความ-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right p-2">
                            ยืนยันรหัสผ่าน :
                        </div>
                        <div class="col-md-10 form-inline">
                            <input type="password" class="form-control" id="cusrepassword" name="cusrepassword" style="width:30%">
                            &nbsp;&nbsp; * (อย่างน้อย 8 ตัวอักษร)
                            <!--ช่องใส่ข้อความ--><br>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success">บันทึก</button> &nbsp;&nbsp;
                    <!--ปุ่มกด-->
                    <button type="reset" class="btn btn-warning">ล้างค่า</button> &nbsp;&nbsp;
                    <!--ปุ่มกด-->
                    <a href="index.php" class="btn btn-danger" role="button">ย้อนกลับ</a>&nbsp;&nbsp;
                    <!--ปุ่มกด-->
                </div>
            </div>
    </div>
    <br>
    <input type="hidden" name="cusid" value="">
    <input type="hidden" name="MM_insert" value="form1">
    </form>
    <p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "real", {validateOn:["blur"], useCharacterMasking:true, minValue:1000000000000, maxValue:9999999999999});
    </script>
</body>

</html>
<?php
mysql_free_result($customer);
?>