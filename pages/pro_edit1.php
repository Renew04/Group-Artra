<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$pc = $_POST['prodcode'];
			$pname = $_POST['prodname'];
            $desc = $_POST['description'];
            $pr = $_POST['price'];
			$Fimage = $_FILES['Fimage']['name'];
            $Fimage_tmp = $_FILES['Fimage']['tmp_name'];
            $Ffolder = 'image/'.$Fimage;
            $Bimage = $_FILES['Bimage']['name'];
            $Bimage_tmp = $_FILES['Bimage']['tmp_name'];
            $Bfolder = 'image/'.$Bimage;

            move_uploaded_file($Fimage_tmp, $Ffolder); 
            move_uploaded_file($Bimage_tmp, $Bfolder); 
		
	 			$query = 'UPDATE product set NAME="'.$pname.'",
					DESCRIPTION="'.$desc.'", PRICE="'.$pr.'", Fimage="'.$Fimage.'", Bimage="'.$Bimage.'" WHERE
					PRODUCT_CODE ="'.$pc.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("You've Update Product Successfully.");
			window.location = "product.php";
		</script>