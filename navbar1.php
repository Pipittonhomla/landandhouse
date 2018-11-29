
<nav class="navbar navbar-expand-lg navbar-light ">
  <a class="navbar-brand" href="#">  <img src="pic/S__7028770.jpg" class="card-img-top" style="width:80%">
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">หน้าแรก <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search1.php">รายการบ้าน-ที่ดิน</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="editcustomer.php?cusid=<?php echo $objResult['cusid']; ?>">แก้ไขข้อมูล</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">ตระกร้าสินค้า</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="showrental.php?cusid=<?php echo $objResult['cusid']; ?>"> รายการจอง</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="payment.php?cusid=<?php echo $objResult['cusid']; ?>"> แจ้งชำระเงิน</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">ติดต่อ</a>
      </li>
     
    </ul>
  </div>
</nav>