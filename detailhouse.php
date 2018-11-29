<?php require_once('Connections/landandhouse.php'); 
  $slhousland = "SELECT * FROM housland WHERE hlid = '".$_GET["hlid"]."' ";
                        
  $housland = mysql_query($slhousland, $landandhouse) or die(mysql_error());
  $detailhouse = mysql_fetch_array($housland); 

  
 
  ?>

<!DOCTYPE html>
<html>

<head>
<?php require_once("navbar1.php");?>

  <meta charset="utf-8">
  <title>รายละเอียดตัวบ้าน </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">


</head>

<body>
  <link rel="stylesheet" href="style.css"><br>

  <div class="container-fluid">
    <div class="card text-dark mb-3" style="background-color:#28a999">
      <div class="card-body text-center text-black">

        <h1>
          <?php echo $detailhouse["hlname"];?>
        </h1>
        <div class="card bordercustom">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <img src="pic/<?php echo $detailhouse["hlpic"];?>" style="width:70%;height:300px;" >
              </div>
              <div class="col-6 text-left">
                <p class="blackcolor"> ชื่อบ้าน-ที่ดิน :
                  <?php echo $detailhouse["hlname"];?>
                </p>
                <p class="blackcolor"> ประเภท :
                  <?php echo $detailhouse["hltype"];?>
                </p>
                <p class="blackcolor"> โฉนดที่ดิน/เลขที่บ้าน :
                  <?php echo $detailhouse["hlnohouse"];?>
                </p>


              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>





</body>

</html>