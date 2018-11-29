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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_employee = 10;
$pageNum_employee = 0;
if (isset($_GET['pageNum_employee'])) {
  $pageNum_employee = $_GET['pageNum_employee'];
}
$startRow_employee = $pageNum_employee * $maxRows_employee;

mysql_select_db($database_landandhouse, $landandhouse);
$query_employee = "SELECT * FROM employee";
$query_limit_employee = sprintf("%s LIMIT %d, %d", $query_employee, $startRow_employee, $maxRows_employee);
$employee = mysql_query($query_limit_employee, $landandhouse) or die(mysql_error());
$row_employee = mysql_fetch_assoc($employee);

if (isset($_GET['totalRows_employee'])) {
  $totalRows_employee = $_GET['totalRows_employee'];
} else {
  $all_employee = mysql_query($query_employee);
  $totalRows_employee = mysql_num_rows($all_employee);
}
$totalPages_employee = ceil($totalRows_employee/$maxRows_employee)-1;

$queryString_employee = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_employee") == false && 
        stristr($param, "totalRows_employee") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_employee = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_employee = sprintf("&totalRows_employee=%d%s", $totalRows_employee, $queryString_employee);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title>แสดง/ลบข้อมูลพนักงาน</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php require_once("navbar.php");?>
  <link rel="stylesheet" href="style.css"><br>
  

  <div class="container-fluid">
    <div class="card bg-basic text-dark">
      <table class="table table-hover">
        <thead>
          <tr class="text-center text-white" bgcolor="#28a999">
            <th colspan="11">
              <b>
                <h1>แสดง/ลบข้อมูลพนักงาน</h1>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-8 form-inline">
                      <input class="form-control" style="width:30%"> &nbsp;&nbsp;
                      <button class="btn btn-light"> ค้นหา </button> &nbsp;&nbsp;
                      <a href="เพิ่มข้อมูลสมาชิก.html" class="btn btn-light" role="button"><i class="fas fa-plus-circle"></i>
                        เพิ่ม
                      </a>
                    </div>
                  </div>
                </div>
              </b>
            </th>
          </tr>
        </thead>
        <thead>
          <tr class="text-secondary">
          <td><b>รหัสพนักงาน</b></td>
                        <td><b>ชื่อ-นามสกุล</b></td>
                        <td><b>หมายเลขบัตรประชาชน</b></td>
                        <td><b>ที่อยู่</b></td>
                        <td><b>เบอร์โทรศัพท์</b></td>
                        <td><b>อีเมล</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
        </thead>
        <tbody>
          <tr class="text-secondary">
  <?php do { ?>
    <tr>
    <td><?php echo $row_employee['empid']; ?></td>
<td><?php echo $row_employee['empname']; ?></td>
      <td><?php echo $row_employee['empidcard']; ?></td>
      <td><?php echo $row_employee['empaddress']; ?></td>
      <td><?php echo $row_employee['emptel']; ?></td>
      <td><?php echo $row_employee['empemail']; ?></td>
      <td><a href="editemployee.php?empid=<?php echo $row_employee['empid']; ?>"><i class="fas fa-edit"></i></a></td>
            <td><a href="delemployee.php?empid=<?php echo $row_employee['empid']; ?>"><i class="fas fa-trash"></i></a></td>
          </tr>
    <?php } while ($row_employee = mysql_fetch_assoc($employee)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_employee > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_employee=%d%s", $currentPage, 0, $queryString_employee); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_employee > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_employee=%d%s", $currentPage, max(0, $pageNum_employee - 1), $queryString_employee); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_employee < $totalPages_employee) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_employee=%d%s", $currentPage, min($totalPages_employee, $pageNum_employee + 1), $queryString_employee); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_employee < $totalPages_employee) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_employee=%d%s", $currentPage, $totalPages_employee, $queryString_employee); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($employee);
?>
