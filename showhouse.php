<!doctype html>

<?php require_once('Connections/landandhouse.php'); 

mysql_select_db($database_landandhouse, $landandhouse);

$strKeyword=null;
if(isset($_POST["txtKeyword"])) {
         $strKeyword=$_POST["txtKeyword"]; 
$query_housland= "SELECT * FROM housland WHERE hlname LIKE '%".$strKeyword."%' ";  
}else{
    $query_housland= "SELECT * FROM housland " ;
}
$housland = mysql_query($query_housland, $landandhouse) or die(mysql_error());
                              


?>


<html>

<head>
    <meta charset="utf-8">
    <title>แสดง/ลบบ้าน-ที่ดิน</title>
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
            <div class="card-body text-white">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1> แสดง/ลบบ้าน-ที่ดิน</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form name="frmSearch " method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                            <div class="row">
                                <div class="col-2 p-0">
                                    <input class="form-control" name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>"
                                        style="width:100%">
                                </div>
                                <div class="col-2  text-left">
                                    <button class="btn btn-light" type="submit" value="Search"> ค้นหา </button> &nbsp;

                                     <a href="inserthouse.php" class="btn btn-light" role="button"><i class="fas fa-plus-circle"></i>
                                        เพิ่ม </a>
                                </div>
                        
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div><br>
    </div>


    <div class="container-fluid">
        <div class="row  justify-content-center">
            <?php
	while($objResult = mysql_fetch_array($housland))
	{

?>
            <div class="col-4 mb-3">
                <div class="card">
                    <img src="pic/<?php echo $objResult["hlpic"];?>" class="card-img-top"
                    style="width:100%;height:300px;">
                    <div class="card-body text-center">
                        <h4 class="card-title">
                            <?php echo $objResult["hlname"];?>
                        </h4>
                        <a href="#" class="btn btn-primary">เลือก</a>
                    </div>
                </div>
            </div>

            <?php
	}
?>
        </div>
        <br>
    </div>


    <?php
mysql_close($landandhouse);
?>
</body>

</html>