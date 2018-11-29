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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE customer SET cususer=%s, cuspassword=%s, cusname=%s, custel=%s, cusaddress=%s, cusidcard=%s, cusemail=%s, cusstatus=%s WHERE cusid=%s",
                       GetSQLValueString($_POST['cususer'], "text"),
                       GetSQLValueString($_POST['cuspassword'], "text"),
                       GetSQLValueString($_POST['cusname'], "text"),
                       GetSQLValueString($_POST['custel'], "text"),
                       GetSQLValueString($_POST['cusaddress'], "text"),
                       GetSQLValueString($_POST['cusidcard'], "text"),
                       GetSQLValueString($_POST['cusemail'], "text"),
                       GetSQLValueString($_POST['cusstatus'], "int"),
                       GetSQLValueString($_POST['cusid'], "int"));

  mysql_select_db($database_landandhouse, $landandhouse);
  $Result1 = mysql_query($updateSQL, $landandhouse) or die(mysql_error());

  $updateGoTo = "home.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_customer = "-1";
if (isset($_GET['cusid'])) {
  $colname_customer = $_GET['cusid'];
}
mysql_select_db($database_landandhouse, $landandhouse);
$query_customer = sprintf("SELECT * FROM customer WHERE cusid = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $landandhouse) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>แก้ไขข้อมูลสมัครสมาชิก</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</head>

<body>
<?php require_once("navbar1.php");?>
<link rel="stylesheet" href="style.css"><br>
<div class="container-fluid">
        <div class="card text-dark" style="background-color:#28a999">
            <div class="card-body text-center text-white">
                <h1> แก้ไขข้อมูลสมาชิก </h1>
            </div>
        </div><br>
        <div class="card text-white" style="background-color:#069">
            <div class="card-body">
                ข้อมูลทั่วไป
            </div>
        </div><br>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <div class="card bg-basic text-dark">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        หมายเลขบัตรประชาชน :
                    </div>
                    <div class="col-md-10 form-inline">
                        <input type="text" class="form-control" name="cusidcard" style="width:30%" value="<?php echo htmlentities($row_customer['cusidcard'], ENT_COMPAT, 'utf-8'); ?>"
            size="32">
                        &nbsp;&nbsp; *
                        (13 ตัวตัวอักษร)
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        ชื่อ - นามสกุล :
                    </div>
                    <div class="col-md-10 form-inline">
                        <input type="text" class="form-control" name="cusname" style="width:30%" value="<?php echo htmlentities($row_customer['cusname'], ENT_COMPAT, 'utf-8'); ?>"
            size="32">
                        &nbsp;&nbsp; *
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        ที่อยู่ :
                    </div>
                    <div class="col-md-10 form-inline">
                        <input type="text" class="form-control" style="width:30%" name="cusaddress" value="<?php echo htmlentities($row_customer['cusaddress'], ENT_COMPAT, 'utf-8'); ?>"
            size="32">
                        &nbsp;&nbsp; *
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        เบอร์โทรศัพท์ :
                    </div>
                    <div class="col-md-10 form-inline">
                        <input type="text" class="form-control" style="width:30%" name="custel" value="<?php echo htmlentities($row_customer['custel'], ENT_COMPAT, 'utf-8'); ?>"
            size="32">
                        &nbsp;&nbsp; * (อย่างน้อย 9 ตัวอักษร)
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        อีเมล์ :
                    </div>
                    <div class="col-md-10 form-inline">
                        <input type="text" class="form-control" style="width:30%" name="cusemail" value="<?php echo htmlentities($row_customer['cusemail'], ENT_COMPAT, 'utf-8'); ?>"
            size="32">
                        &nbsp;&nbsp; *
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">บันทึก</button> &nbsp;&nbsp;
                <button type="reset" class="btn btn-warning">คืนค่า</button> &nbsp;&nbsp; <!--คืนค่ายังไงน้าาาาาาา-->
                <a href="home.php" class="btn btn-danger" role="button">ยกเลิก</a>&nbsp;&nbsp;
            </div>
        </div>
    </div>
    <br>
    <input type="hidden" name="cusid" value="<?php echo $row_customer['cusid']; ?>">
    <input type="hidden" name="cususer" value="<?php echo htmlentities($row_customer['cususer'], ENT_COMPAT, 'utf-8'); ?>">
    <input type="hidden" name="cuspassword" value="<?php echo htmlentities($row_customer['cuspassword'], ENT_COMPAT, 'utf-8'); ?>">
    <input type="hidden" name="cusstatus" value="<?php echo htmlentities($row_customer['cusstatus'], ENT_COMPAT, 'utf-8'); ?>">
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="cusid" value="<?php echo $row_customer['cusid']; ?>">
  </form>
  <p>&nbsp;</p>
</body>

</html>
<?php
mysql_free_result($customer);
?>