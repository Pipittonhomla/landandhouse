<!doctype html>


<?php
mysql_connect("localhost","root","");
	mysql_select_db("landandhouse");
     $house = "SELECT * FROM housland ";
    $objQueryhouse = mysql_query($house);
    
    $strKeyword1 = "บ้าน";
    $strKeyword2 = "ที่ดิน,พื้นที่";


    $topichouse1 = "SELECT * FROM housland WHERE hltype LIKE '%".$strKeyword1."%' " ;
	$objQuerytopichouse = mysql_query($topichouse1);

    $topichouse2 = "SELECT * FROM housland WHERE hltype LIKE '%".$strKeyword2."%' " ;
	$objQuerytopichouse2 = mysql_query($topichouse2);

?>
<html>

<head>
    <meta charset="utf-8">

    <title>หน้าแรกก่อนเข้าสู่ระบบ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</head>

<body>
    <link rel="stylesheet" href="style.css">
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 text-center">
                <img src="pic/S__7028770.jpg" class="card-img-top" style="width:80%">
            </div>
            <div class="col-8">
                <div class="card" style="background-color:#28a999">
                    <div class="card-body text-center text-white">
                        <h1><b><i class="fas fa-angle-double-right"></i> นิเวศน์เช่าที่ดิน <i class="fas fa-angle-double-left"></i></b>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card text-dark" style="background-color:#28a999;height: 85%;">
                    <div class="card-body text-center text-white">

                        <a href="login.php" class="btn btn-danger" role="button" style="margin-top: 12px;">
                            เข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <nav class="navbar navbar-expand-sm style=" background-color:#069" navbar-dark">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="insertcustomer.php">สมัครสมาชิก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">ติดต่อ</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">คู่มือ</a>
            </li>
        </ul>
    </nav>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="card bg-basic text-dark text-center">
                    <div class="card-body">
                        <h5><b>ที่ดิน หรือ พื้นที่</h5></b><br>
                       <div class="text-left">
                            <?php
                while($qrr0index=mysql_fetch_array($objQuerytopichouse2))
                {
                ?>
                            <p> <a href="detailhouse.php?hlid=<?php echo $qrr0index["hlid"];?>"><i class="fas fa-play-circle"></i>
                                    บ้าน
                                    <?php echo $qrr0index["hlname"];?></a> </p>

                                    <?php   }
?>
                        </div><br>
                        <h5><b>บ้าน</b></h5><br>
                        <div class="text-left">
                           <?php
                while($qr0=mysql_fetch_array($objQuerytopichouse))
                {
                ?>
                            <p> <a href="detailhouse.php?hlid=<?php echo $qr0["hlid"];?>"><i class="fas fa-play-circle"></i>
                                    บ้าน
                                    <?php echo $qr0["hlname"];?></a> </p>

                            <?php   }
?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row  justify-content-center">
                    <?php
                while($qr=mysql_fetch_array($objQueryhouse))
                {
                ?>
                    <div class="col-4 mb-3">
                        <div class="card">
                            <img src="pic/<?php echo $qr["hlpic"];?>" class="card-img-top"
                            style="width:100%;height:300px;"
                            <div class="card-body text-center ">
                                <h4 class="card-title text-center mt-2">
                                    <?php echo $qr["hlname"];?>
                                </h4>
                                <div class="col-12 text-center mb-3"> <a href="#" class="btn btn-primary">เลือก</a>
                                </div>
                            </div>
                        </div>
                        <?php   }
?>

                    
            </div>
        </div>
    </div>

</body>

</html>