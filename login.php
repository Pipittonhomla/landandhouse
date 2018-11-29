<!doctype html>
<?php require_once('Connections/landandhouse.php'); ?>
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
      <div class="col-10">
        <div class="card" style="background-color:#28a999">
          <div class="card-body text-center text-white">
            <h1><b><i class="fas fa-angle-double-right"></i> นิเวศน์เช่าที่ดิน <i class="fas fa-angle-double-left"></i></b>
            </h1>
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
              <a href="#"><i class="fas fa-play-circle"></i> ป้อมหนึ่ง</a><br>
              <a href="#"><i class="fas fa-play-circle"></i> ตัดใหม่</a><br>
            </div><br>
            <h5><b>บ้าน</b></h5><br>
            <div class="text-left">
              <a href="#"><i class="fas fa-play-circle"></i> บ้านชบา</a><br>
              <a href="#"><i class="fas fa-play-circle"></i> บ้านกุหลาบ</a><br>
              <a href="#"><i class="fas fa-play-circle"></i> บ้านกล้วยไม้</a><br>
              <a href="#"><i class="fas fa-play-circle"></i> บ้านลีลาวดี</a><br>
              <a href="#"><i class="fas fa-play-circle"></i> บ้านดาวเรือง</a><br>
              <a href="#"><i class="fas fa-play-circle"></i> บ้านลิลลี่</a><br>
            </div>
          </div>
        </div>
      </div>
      <div class="col-9 mt-5">
        <form namse="form1" method="post" action="cklogin.php">

          <div class="row">

            <div class="col-md-3 text-right p-2">
              ชื่อผู้ใช้ :
            </div>
            <div class="col-md-9 form-inline">
              <input type="text" class="form-control" id="cususer" name="cususer" style="width:50%"> &nbsp;&nbsp; *
            </div>
          </div>

          <div class="row">

            <div class="col-md-3 text-right p-2">
              รหัสผ่าน :
            </div>
            <div class="col-md-9 form-inline">
              <input type="password" class="form-control" id="cuspassword" name="cuspassword" style="width:50%">
              &nbsp;&nbsp; *
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-3"> </div>
            <div class="col-5 text-center">
              <button type="submit" name="Submit" value="Login" class="btn btn-success">ตกลง</button> &nbsp;&nbsp;
              <button type="reset" class="btn btn-danger">ยกเลิก</button> &nbsp;&nbsp;
              <a href="index.php" class="btn btn-warning" role="button">ย้อนกลับ</a>&nbsp;&nbsp;
              <!--ปุ่มกด-->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>