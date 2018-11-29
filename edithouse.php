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
  $updateSQL = sprintf("UPDATE housland SET hlname=%s, hlrent=%s, hltitledeed=%s, hlnodeed=%s, hlpic=%s, hlnohouse=%s, hltype=%s, hlstatus=%s WHERE hlid=%s",
                       GetSQLValueString($_POST['hlname'], "text"),
                       GetSQLValueString($_POST['hlrent'], "int"),
                       GetSQLValueString($_POST['hltitledeed'], "text"),
                       GetSQLValueString($_POST['hlnodeed'], "text"),
                       GetSQLValueString($_POST['hlpic'], "text"),
                       GetSQLValueString($_POST['hlnohouse'], "text"),
                       GetSQLValueString($_POST['hltype'], "text"),
                       GetSQLValueString($_POST['hlstatus'], "int"),
                       GetSQLValueString($_POST['hlid'], "int"));

  mysql_select_db($database_landandhouse, $landandhouse);
  $Result1 = mysql_query($updateSQL, $landandhouse) or die(mysql_error());

  $updateGoTo = "listhouse.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_housland = "-1";
if (isset($_GET['hlid'])) {
  $colname_housland = $_GET['hlid'];
}
mysql_select_db($database_landandhouse, $landandhouse);
$query_housland = sprintf("SELECT * FROM housland WHERE hlid = %s", GetSQLValueString($colname_housland, "int"));
$housland = mysql_query($query_housland, $landandhouse) or die(mysql_error());
$row_housland = mysql_fetch_assoc($housland);
$totalRows_housland = mysql_num_rows($housland);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Hlid:</td>
      <td><?php echo $row_housland['hlid']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ชื่อบ้าน:</td>
      <td><input type="text" name="hlname" value="<?php echo htmlentities($row_housland['hlname'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">อัตราค่าเช่า:</td>
      <td><input type="text" name="hlrent" value="<?php echo htmlentities($row_housland['hlrent'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">โฉนดที่ดิน:</td>
      <td><input type="text" name="hltitledeed" value="<?php echo htmlentities($row_housland['hltitledeed'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">เลขโฉนดที่ดิน:</td>
      <td><input type="text" name="hlnodeed" value="<?php echo htmlentities($row_housland['hlnodeed'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">รูปบ้าน:</td>
      <td><input type="text" name="hlpic" value="<?php echo htmlentities($row_housland['hlpic'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">เลขที่บ้าน:</td>
      <td><input type="text" name="hlnohouse" value="<?php echo htmlentities($row_housland['hlnohouse'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ประเภท:</td>
      <td><input type="text" name="hltype" value="<?php echo htmlentities($row_housland['hltype'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">สถานะ:</td>
      <td><input type="text" name="hlstatus" value="<?php echo htmlentities($row_housland['hlstatus'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="hlid" value="<?php echo $row_housland['hlid']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($housland);
?>
