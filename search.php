<!doctype html>

<?php require_once('Connections/landandhouse.php'); 



 $strKeyword=null;
if(isset($_POST["txtKeyword"])) {
         $strKeyword=$_POST["txtKeyword"]; 
         $slhousland = "SELECT * FROM housland  WHERE hlname LIKE '%".$strKeyword."%' "; 
  }else{
  $slhousland = "SELECT * FROM housland";
                              }
  $housland = mysql_query($slhousland, $landandhouse) or die(mysql_error());

?>
<html>

<head>
    <meta charset="utf-8">
    <title>แสดง/บ้าน-ที่ดิน ทั้งหมด</title>
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
        <div class="card text-dark" style="background-color:#28a999">
            <div class="card-body text-center text-white">
                <h1> แสดงบ้านและที่ดินทั้งหมด</h1>
                <br>
                <div class="row">
                    <div class="col-12 form-inline">
                        <form name="frmSearch " method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">

                            <input class="form-control" name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>"
                                style="width:70%"> &nbsp;&nbsp;
                            <button class="btn btn-light" type="submit" value="Search"> ค้นหา </button>
                        </form>

                    </div>
                </div>
            </div>
        </div><br>
    </div>
    <div class="container-fluid">
        <div class="row  justify-content-center">
            <?php
                while($allhl=mysql_fetch_array($housland))
                {
                ?>
            <div class="col-4 mb-3">
                <div class="card">
                    <img src="pic/<?php echo $allhl["hlpic"];?>" class="card-img-top"
                    style="width:100%;height:300px;">
                    <div class="card-body text-center">
                        <h4 class="card-title">
                            <?php echo $allhl["hlname"];?>
                        </h4>
                        <a href="#" class="btn btn-primary">เลือก</a>
                    </div>
                </div>
            </div>
            <?php   }
?>
        </div>
    </div>
    </div>


    <?php
mysql_close($landandhouse);
?>
</body>

</html>