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

$maxRows_customer = 10;
$pageNum_customer = 0;
if (isset($_GET['pageNum_customer'])) {
  $pageNum_customer = $_GET['pageNum_customer'];
}
$startRow_customer = $pageNum_customer * $maxRows_customer;

mysql_select_db($database_landandhouse, $landandhouse);
$query_customer = "SELECT * FROM customer";
$query_limit_customer = sprintf("%s LIMIT %d, %d", $query_customer, $startRow_customer, $maxRows_customer);
$customer = mysql_query($query_limit_customer, $landandhouse) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

if (isset($_GET['totalRows_customer'])) {
  $totalRows_customer = $_GET['totalRows_customer'];
} else {
  $all_customer = mysql_query($query_customer);
  $totalRows_customer = mysql_num_rows($all_customer);
}
$totalPages_customer = ceil($totalRows_customer/$maxRows_customer)-1;

$queryString_customer = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_customer") == false && 
        stristr($param, "totalRows_customer") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_customer = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_customer = sprintf("&totalRows_customer=%d%s", $totalRows_customer, $queryString_customer);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>แสดง/ลบข้อมูลลูกค้า</title>
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
                <h1>แสดง/ลบข้อมูลลูกค้า</h1>
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
            <td><b>รหัสลูกค้า</b></td>
            <td><b>ชื่อ-นามสกุล</b></td>
            <td><b>หมายเลขบัตรประชาชน</b></td>
            <td><b>ที่อยู่</b></td>
            <td><b>เบอร์โทรศัพท์</b></td>
            <td><b>อีเมล</b></td>
            <td></td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr class="text-secondary">
            <?php do { ?>
          <tr>
            <td>
              <?php echo $row_customer['cusid']; ?>
            </td>
            <td>
              <?php echo $row_customer['cusname']; ?>
            </td>
            <td>
              <?php echo $row_customer['cusidcard']; ?>
            </td>
            <td>
              <?php echo $row_customer['cusaddress']; ?>
            </td>
            <td>
              <?php echo $row_customer['custel']; ?>
            </td>
            <td>
              <?php echo $row_customer['cusemail']; ?>
            </td>
            <td><a href="editcustomer.php?cusid=<?php echo $row_customer['cusid']; ?>"><i class="fas fa-edit"></i></a></td>
            <td><a href="delcustomer.php?cusid=<?php echo $row_customer['cusid']; ?>"><i class="fas fa-trash"></i></a></td>
          </tr>
          <?php } while ($row_customer = mysql_fetch_assoc($customer)); ?>
        </tbody>
      </table>
      <table border="0">
        <tr>
          <td>
            <?php if ($pageNum_customer > 0) { // Show if not first page ?>
            <a href="<?php printf(" %s?pageNum_customer=%d%s", $currentPage, 0, $queryString_customer); ?>">First</a>
            <?php } // Show if not first page ?>
          </td>
          <td>
            <?php if ($pageNum_customer > 0) { // Show if not first page ?>
            <a href="<?php printf(" %s?pageNum_customer=%d%s", $currentPage, max(0, $pageNum_customer - 1),
              $queryString_customer); ?>">Previous</a>
            <?php } // Show if not first page ?>
          </td>
          <td>
            <?php if ($pageNum_customer < $totalPages_customer) { // Show if not last page ?>
            <a href="<?php printf(" %s?pageNum_customer=%d%s", $currentPage, min($totalPages_customer,
              $pageNum_customer + 1), $queryString_customer); ?>">Next</a>
            <?php } // Show if not last page ?>
          </td>
          <td>
            <?php if ($pageNum_customer < $totalPages_customer) { // Show if not last page ?>
            <a href="<?php printf(" %s?pageNum_customer=%d%s", $currentPage, $totalPages_customer,
              $queryString_customer); ?>">Last</a>
            <?php } // Show if not last page ?>
          </td>
        </tr>
      </table>
      </p>
    </div>
  </div>
</body>
</html>
<?php
mysql_free_result($customer);
?>