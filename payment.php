
<?php require_once('Connections/landandhouse.php'); 

mysql_select_db($database_landandhouse, $landandhouse);



// ดููท่าจะต้องจอยเทเบิ้ล
$query_rental= "SELECT * FROM rental  WHERE cusid = '".$_GET["cusid"]."' ";
$rental = mysql_query($query_rental, $landandhouse) or die(mysql_error());
                              

$query_customer= "SELECT * FROM customer  WHERE cusid = '".$_GET["cusid"]."' ";
$customer = mysql_query($query_customer, $landandhouse) or die(mysql_error());
                              

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>แจ้งชำระเงิน</title>
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
        <div class="card text-dark" style="background-color:#28a999">
            <div class="card-body text-center text-white">
                <h1> แจ้งชำระเงิน </h1>
            </div>
        </div><br>

        <div class="card bg-basic text-dark">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        รหัสการจอง :
                    </div>
                    <div class="col-md-10 form-inline">
                        001
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        ชื่อลูกค้า :
                    </div>
                    <div class="col-md-10 form-inline">
                        มาลี สวยมาก
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        จำนวนเงินมัดจำรวม :
                    </div>
                    <div class="col-md-10 form-inline">
                        10000
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        วันที่แจ้ง :
                    </div>
                    <div class="col-md-10 form-inline">
                        <input type="date" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-right p-2">
                        หลักฐานการชำระเงิน :
                    </div>
                    <div class="col-md-10 form-inline">
                        <div style="position:relative;">
                            <a class='btn btn-info' href='javascript:;'>
                                Choose File...
                                <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'
                                    name="file_source" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                            </a>
                            &nbsp;
                            <span class='label label-info' id="upload-file-info"></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="card bg-basic text-dark">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-left text-white" bgcolor="#28a999">
                                    <th colspan="7"><b>รายละเอียดการจอง</b></th>
                                </tr>
                            </thead>
                            <thead>
                                <tr class="text-secondary">

                                    <td><b>ชื่อบ้าน-ที่ดิน</b></td>
                                    <td><b>หน่วยนับ</b></td>
                                    <td><b>ค่ามัดจำ</b></td>
                                    <td><b>จำนวน</b></td>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                 <?php
	while($objResult = mysql_fetch_array($rental))
	{?>
                                <tr class="text-secondary">




                                    <td>บ้านชบา</td>
                                    <td><?php echo $objResult["rentype"];?></td>
                                    <td>5000</td>
                                    <td>1</td>
                                   

                                </tr>
                                     <?php
	}
?>
                                <tr class="text-secondary">
                                    <td ></td>
                                    <td>รวมค่ามัดจำ (บาท)</td>
                                    <td>10000</td>
                                    <td></td>
                                </tr>
                                     
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="register" class="btn btn-success">บันทึก</button> &nbsp;&nbsp;
                            <button type="register" class="btn btn-danger">ล้างค่า</button> &nbsp;&nbsp;
                                <a href="../หน้าหลัก.html" class="btn btn-warning" role="button">กลับ</a>&nbsp;&nbsp;
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <br>
    </div>
</body>

</html>