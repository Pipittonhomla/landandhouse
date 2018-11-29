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
  $insertSQL = sprintf("INSERT INTO housland (hlid, hlname, hltype, hlnohouse) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['hu'], "text"));

  mysql_select_db($database_landandhouse, $landandhouse);
  $Result1 = mysql_query($insertSQL, $landandhouse) or die(mysql_error());

  $insertGoTo = "inserthouse.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_landandhouse, $landandhouse);
$query_customer = "SELECT * FROM housland";
$customer = mysql_query($query_customer, $landandhouse) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <title>เพิ่มข้อมูลบ้าน-ที่ดิน</title>
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
        <h1> เพิ่มข้อมูลบ้าน-ที่ดิน </h1>
      </div>
    </div>
    <br>
    <div class="card bg-basic text-dark">
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data" name="form1" action="houseinsertdb.php">

          <div class="row">
            <div class="col-md-2 text-right p-2">
              ชื่อบ้าน-ที่ดิน :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" id="name" name="name" style="width:50%">
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 text-right p-2">
              ประเภท :
            </div>
            <div class="col-md-10 form-inline">
              <label for="type"></label>
              <select name="type" id="type" class="form-control" style="width:50%">
                <option value="บ้าน">บ้าน</option>
                <option value="ที่ดิน,พื้นที่">ที่ดิน,พื้นที่</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 text-right p-2">
              โฉนดที่ดิน/เลขที่บ้าน :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" id="hu" name="hu" style="width:50%">
            </div>
          </div>

              <div class="row">
            <div class="col-md-2 text-right p-2">
              ค่าเช้าบ้าน :
            </div>
            <div class="col-md-10 form-inline">
              <input type="text" class="form-control" id="rent" name="rent" style="width:50%">
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 text-right p-2">
              เพิ่มรูปบ้าน-ที่ดิน :
            </div>
            <div class="col-md-10">
              <div style="position:relative;">
                <a class='btn btn-info' href='javascript:;'>
                  Choose File...
                  <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'
                    name="image" id="image" size="40" onchange='$("#image").html($(this).val());'>
                </a>
                &nbsp;
                <span class='label label-info' id="image"></span>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" name="submit" value="submit" class="btn btn-success">บันทึก</button> &nbsp;&nbsp;
              <button type="reset" class="btn btn-warning">ล้างค่า</button> &nbsp;&nbsp;
              <a href="home.php" class="btn btn-danger" role="button">ยกเลิก</a>&nbsp;&nbsp;
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  <br>
</body>

</html>