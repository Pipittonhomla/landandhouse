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
  $updateSQL = sprintf("UPDATE employee SET empuser=%s, emppassword=%s, empname=%s, emptel=%s, empaddress=%s, empidcard=%s, empemail=%s, empstatus=%s WHERE empid=%s",
                       GetSQLValueString($_POST['empuser'], "text"),
                       GetSQLValueString($_POST['emppassword'], "text"),
                       GetSQLValueString($_POST['empname'], "text"),
                       GetSQLValueString($_POST['emptel'], "text"),
                       GetSQLValueString($_POST['empaddress'], "text"),
                       GetSQLValueString($_POST['empidcard'], "text"),
                       GetSQLValueString($_POST['empemail'], "text"),
                       GetSQLValueString($_POST['empstatus'], "int"),
                       GetSQLValueString($_POST['empid'], "int"));

  mysql_select_db($database_landandhouse, $landandhouse);
  $Result1 = mysql_query($updateSQL, $landandhouse) or die(mysql_error());

  $updateGoTo = "listemployee.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_employee = "-1";
if (isset($_GET['empid'])) {
  $colname_employee = $_GET['empid'];
}
mysql_select_db($database_landandhouse, $landandhouse);
$query_employee = sprintf("SELECT * FROM employee WHERE empid = %s", GetSQLValueString($colname_employee, "int"));
$employee = mysql_query($query_employee, $landandhouse) or die(mysql_error());
$row_employee = mysql_fetch_assoc($employee);
$totalRows_employee = mysql_num_rows($employee);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>แก้ไขข้อมูลพนักงาน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
</head>

<body>
<?php require_once("navbar.php");?>
  <link rel="stylesheet" href="style.css"><br>
  <div class="container-fluid">
    <div class="card text-dark" style="background-color:#28a999">
      <div class="card-body text-center text-white">
        <h1> แก้ไขข้อมูลพนักงาน </h1>
      </div>
    </div><br>
    <div class="card text-white" style="background-color:#069">
      <div class="card-body">
        ข้อมูลทั่วไป
      </div>
    </div><br>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <div class="card bg-basic text-dark">
        <div class="card-body">
          <div class="row">
            <div class="col-md-2 text-right p-2">
              หมายเลขบัตรประชาชน :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" name="empidcard" style="width:30%" value="<?php echo htmlentities($row_employee['empidcard'], ENT_COMPAT, 'utf-8'); ?>"
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
              <input type="text" class="form-control" name="empname" style="width:30%" value="<?php echo htmlentities($row_employee['empname'], ENT_COMPAT, 'utf-8'); ?>"
                size="32">
              &nbsp;&nbsp; *
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 text-right p-2">
              ที่อยู่ :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" style="width:30%" name="empaddress" value="<?php echo htmlentities($row_employee['empaddress'], ENT_COMPAT, 'utf-8'); ?>"
                size="32">
              &nbsp;&nbsp; *
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 text-right p-2">
              เบอร์โทรศัพท์ :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" style="width:30%" name="emptel" value="<?php echo htmlentities($row_employee['emptel'], ENT_COMPAT, 'utf-8'); ?>"
                size="32">
              &nbsp;&nbsp; * (อย่างน้อย 9 ตัวอักษร)
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 text-right p-2">
              อีเมล์ :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" style="width:30%" name="empemail" value="<?php echo htmlentities($row_employee['empemail'], ENT_COMPAT, 'utf-8'); ?>"
                size="32" />
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
          <button type="reset" class="btn btn-warning">คืนค่า</button> &nbsp;&nbsp;
          <!--คืนค่ายังไงน้าาาาาาา-->
          <a href="home.php" class="btn btn-danger" role="button">ยกเลิก</a>&nbsp;&nbsp;
        </div>
      </div>
  </div>
  <br>
  <input type="hidden" name="empid" value="<?php echo $row_employee['empid']; ?>" />
  <input type="hidden" name="empuser" value="<?php echo htmlentities($row_employee['empuser'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="emppassword" value="<?php echo htmlentities($row_employee['emppassword'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="empstatus" value="<?php echo htmlentities($row_employee['empstatus'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="empid" value="<?php echo $row_employee['empid']; ?>" />
  </form>
  <p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($employee);
?>
