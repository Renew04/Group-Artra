<?php
include('../includes/connection.php');
		$query = 'SELECT PRODUCT_ID,PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE PRODUCT_ID ='.$_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        while($row = mysqli_fetch_array($result))
        {   
        $pcc = $row['PRODUCT_CODE'];
        }
        $id = $_GET['id'];
        $stats = $_GET['status'];
        if($stats == "active"){
            $query = 'UPDATE product set stats="Active" WHERE
					PRODUCT_CODE ="'.$pcc.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
            echo "<script type='text/javascript'>alert('Product Activated'); window.location = 'product.php';</script>";
        }else if($stats == "inactive"){
            $query = 'UPDATE product set stats="Inactive" WHERE
                    PRODUCT_CODE ="'.$pcc.'"';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
            echo "<script type='text/javascript'>alert('Product Inactivated'); window.location = 'product.php';</script>";
        }else{
            echo "<script type='text/javascript'>alert('Error'); window.location = 'product.php';</script>";
        }
?>