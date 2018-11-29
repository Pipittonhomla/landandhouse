<?php
	include("Connections/db.php");
	include("Connections/functions.php");
    
    ini_set('display_errors', 1);
    error_reporting(~0);

	if(isset($_REQUEST['command'])=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if(isset($_REQUEST['command'])=='clear'){
		unset($_SESSION['cart']);
	}
	else if(isset($_REQUEST['command'])=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['hlid'];
			$q=intval($_REQUEST['housland'.$pid]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>เลือกรายการจอง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">


    <script language="javascript">
        function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
</head>

<body>
    <?php require_once("navbar1.php");?>
    <form name="form1" method="post">
        <input type="hidden" name="pid" />
        <input type="hidden" name="command" />



        <link rel="stylesheet" href="../style.css"><br>

        <div class="container-fluid">
            <div class="card bg-basic text-dark">
                <table class="table table-hover">

                    <thead>
                        <tr class="text-center text-white" bgcolor="#28a999">
                            <th colspan="7"><b>
                                    <h1>เลือกรายการจอง</h1>
                                </b></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="text-secondary">
                            <td width="200"><b>รูปภาพ</b></td>
                            <td><b>ชื่อบ้าน-ที่ดิน</b></td>
                            <td><b>หน่วยนับ</b></td>
                            <td><b>มัดจำ(บาท)</b></td>
                            <td><b>จำนวน</b></td>
                            <td><b>ราคาเช่า(บาท)</b></td>
                            <td><b></b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
			if(is_array($_SESSION['cart'])){
            	
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['hlid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>

                        <tr class="text-secondary">
                            <td><img src="pic/<?php echo get_img($pid);?>" class="card-img-top" style="width:200px">

                            </td>
                            <td>
                                <?php echo $pname?>
                            </td>
                            <td>
                                <?php echo get_type($pid)?>
                            </td>
                            <td>5000</td>
                            <td><input type="text" name="housland<?php echo $pid?>" value="<?php echo $q?>" maxlength="3"
                                    size="2" /></td>
                            <td>$
                                <?php echo get_price($pid)?>
                            </td>
                            <td>
                                <a href="javascript:del(<?php echo $pid?>)"><i class="fas fa-trash-alt"></i></td> </a>
                            &nbsp;&nbsp;
                            </td>

                        </tr>

                        <?php					
				}
            ?>
                        <tr class="text-secondary">
                            <td colspan="4"></td>
                            <td>รวม (บาท)</td>
                            <td>$
                                <?php echo get_order_total()?>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div><br>
            <div class="row">
                <div class="col-12 text-right">
                    <a href="search1.php" class="btn btn-warning" role="button">จองเพิ่ม</a>&nbsp;&nbsp;
                    <a href="cartdetail.php" class="btn btn-success" role="button">ยืนยันการจอง</a>&nbsp;&nbsp;
                    <input type="button" value="ล้างตระกร้าสินค้า" onclick="clear_cart()" class="btn btn-danger">
                    &nbsp;&nbsp;
                </div>
            </div>
            <?php
            }
			else{
			?>  <h2 class="text-center"> <?php echo "ไม่มีสินค้าในตระกร้า โปรดเลือกรายการสินค้า!"; ?> </h2>
		<?php 	}
		?>
        </div>
        <br>
</body>

</html>