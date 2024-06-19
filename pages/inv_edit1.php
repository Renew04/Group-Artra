<?php
include('../includes/connection.php');
			$zz = $_POST['idd'];
			$pc = $_POST['ProdCode'];
			$pn = $_POST['ProdName'];
            $a = $_POST['qty'];
			$dc = $_POST['descript'];
			$pr = $_POST['pricing'];
			$ctg = $_POST['categorize'];
			$dats = $_POST['DateStock'];
			$Fimage = $_POST['Fimage'];
            $Bimage = $_POST['Bimage'];
		
			switch($_GET['action']){
                case 'add':  
                for($i=0; $i < $a; $i++){
                    $query = "INSERT INTO product
                              (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, CATEGORY_ID, DATE_STOCK_IN, Fimage, Bimage)
                              VALUES (Null,'{$pc}','{$pn}','{$dc}',1,{$pr},{$ctg},'{$dats}','{$Fimage}','{$Bimage}')";
                    mysqli_query($db,$query)or die ('Error in updating inventory item in Database '.$query);
                    }
                break;
              } 
?>	
	<script type="text/javascript">
			alert("You've Update Product Successfully.");
			window.location = "inventory.php";
		</script>