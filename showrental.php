

<?php require_once('Connections/landandhouse.php'); 

mysql_select_db($database_landandhouse, $landandhouse);


$query_rental= "SELECT * FROM rental  WHERE cusid = '".$_GET["cusid"]."' ";

$rental = mysql_query($query_rental, $landandhouse) or die(mysql_error());
                              


?>

<!doctype html>
<html>

<head>
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>แสดงรายการจองบ้าน-ที่ดิน</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
            crossorigin="anonymous">
    </head>

<body>
    <link rel="stylesheet" href="../style.css"><br>

    <div class="container-fluid">
        <div class="card bg-basic text-dark">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center text-white" bgcolor="#28a999">
                        <th colspan="11"><b>
                                <h1>แสดงรายการจองบ้าน-ที่ดิน</h1>
                            </b>
                        </th>
                    </tr>
                </thead>
                <thead>
                    <tr class="text-secondary">
                        <td><b>รหัสจอง</b></td>
                        <td><b>วันทีจอง</b></td>
                        <td><b>รหัสลูกค้า</b></td>
                        <td><b>ประเภท</b></td>
                        <td><b>ยอดรวมมัดจำสุทธิ</b></td>
                        <td><b>สถานะ</b></td>
                        <td width="200"></td>
                    </tr>
                </thead>
                <tbody>
                   <?php
	while($objResult = mysql_fetch_array($rental))
	{

?>
                    <tr class="text-secondary">
                        <td>R0<?php echo $objResult["renid"];?></td>
                        <td><?php echo $objResult["rendate"];?></td>
                        <td><?php echo $objResult["cusid"];?></td>
                        <td><?php echo $objResult["rentype"];?></td>
                        <td>5000</td>
                        <td style="color:#F00">จ่ายแล้ว</td>
                        <td align-right>
                            <button type="register" class="btn btn-success">บันทึก</button> &nbsp;&nbsp;
                            <button type="register" class="btn btn-danger">ล้างค่า</button> &nbsp;&nbsp;
                        </td>
                    </tr>
                         <?php
	}
?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-12 text-right">
                <a href="../หน้าหลัก.html" class="btn btn-warning" role="button">กลับ</a>
            </div>
        </div>
    </div>
</body>

</html>