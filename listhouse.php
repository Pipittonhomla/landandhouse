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

$maxRows_housland = 10;
$pageNum_housland = 0;
if (isset($_GET['pageNum_housland'])) {
  $pageNum_housland = $_GET['pageNum_housland'];
}
$startRow_housland = $pageNum_housland * $maxRows_housland;

mysql_select_db($database_landandhouse, $landandhouse);
$query_housland = "SELECT * FROM housland";
$query_limit_housland = sprintf("%s LIMIT %d, %d", $query_housland, $startRow_housland, $maxRows_housland);
$housland = mysql_query($query_limit_housland, $landandhouse) or die(mysql_error());
$row_housland = mysql_fetch_assoc($housland);

if (isset($_GET['totalRows_housland'])) {
  $totalRows_housland = $_GET['totalRows_housland'];
} else {
  $all_housland = mysql_query($query_housland);
  $totalRows_housland = mysql_num_rows($all_housland);
}
$totalPages_housland = ceil($totalRows_housland/$maxRows_housland)-1;

$queryString_housland = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_housland") == false && 
        stristr($param, "totalRows_housland") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_housland = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_housland = sprintf("&totalRows_housland=%d%s", $totalRows_housland, $queryString_housland);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>แสดงข้อมูลบ้าน</title>
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
    <div class="card bg-basic text-dark">
      <table class="table table-hover">
        <thead>
          <tr class="text-center text-white" bgcolor="#28a999">
            <th colspan="11"><b>
                <h1>แสดง/ลบข้อมูลบ้าน </h1>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-8 form-inline">
                      <!--<input class="form-control" style="width:30%"> &nbsp;&nbsp;
                      <button class="btn btn-light"> ค้นหา </button> &nbsp;&nbsp;
                      <a href="เพิ่มข้อมูลพนักงาน.html" class="btn btn-light" role="button"><i class="fas fa-plus-circle"></i>
                        เพิ่ม
                      </a>-->
                    </div>
                  </div>
                </div>
              </b>
            </th>
          </tr>
        </thead>
        <thead>
          <tr class="text-secondary">
            <td>รหัสบ้าน</td>
            <td>ชื่อบ้าน</td>
            <td>อัตราค่าเช่า</td>
            <td>โฉนดที่ดิน</td>
            <td>เลขโฉนดที่ดิน</td>
            <td>รูปบ้าน</td>
            <td>เลขที่บ้าน</td>
            <td>ประเภท</td>
            <td>แก้ไข</td>
            <td>ลบ</td>
          </tr>
          <?php do { ?>
        </thead>
        <tbody>
          <tr class="text-secondary">
            <td>
              <?php echo $row_housland['hlid']; ?>
            </td>
            <td>
              <?php echo $row_housland['hlname']; ?>
            </td>
            <td>
              <?php echo $row_housland['hlrent']; ?>
            </td>
            <td>
              <?php echo $row_housland['hltitledeed']; ?>
            </td>
            <td>
              <?php echo $row_housland['hlnodeed']; ?>
            </td>
            <td><img src="pic/<?php echo $row_housland['hlpic'];?>" class="card-img-top" style="width:150px;">
            <td>
              <?php echo $row_housland['hlnohouse']; ?>
            </td>
            <td>
              <?php echo $row_housland['hltype']; ?>
            </td>
            <td><a href="edithouse.php?hlid=<?php echo $row_housland['hlid']; ?>"><i class="fas fa-edit"></i></a></td>
            <td><a href="delhouse.php?hlid=<?php echo $row_housland['hlid']; ?>"><i class="fas fa-trash"></i></a></td>
          </tr>
          <?php } while ($row_housland = mysql_fetch_assoc($housland)); ?>
        </tbody>
      </table>
      <table border="0">
        <tr>
          <td>
            <?php if ($pageNum_housland > 0) { // Show if not first page ?>
            <a href="<?php printf(" %s?pageNum_housland=%d%s", $currentPage, 0, $queryString_housland); ?>">First</a>
            <?php } // Show if not first page ?>
          </td>
          <td>
            <?php if ($pageNum_housland > 0) { // Show if not first page ?>
            <a href="<?php printf(" %s?pageNum_housland=%d%s", $currentPage, max(0, $pageNum_housland - 1),
              $queryString_housland); ?>">Previous</a>
            <?php } // Show if not first page ?>
          </td>
          <td>
            <?php if ($pageNum_housland < $totalPages_housland) { // Show if not last page ?>
            <a href="<?php printf(" %s?pageNum_housland=%d%s", $currentPage, min($totalPages_housland,
              $pageNum_housland + 1), $queryString_housland); ?>">Next</a>
            <?php } // Show if not last page ?>
          </td>
          <td>
            <?php if ($pageNum_housland < $totalPages_housland) { // Show if not last page ?>
            <a href="<?php printf(" %s?pageNum_housland=%d%s", $currentPage, $totalPages_housland,
              $queryString_housland); ?>">Last</a>
            <?php } // Show if not last page ?>
          </td>
        </tr>
      </table>
      </p>
</body>

</html>
<?php
mysql_free_result($housland);
?>