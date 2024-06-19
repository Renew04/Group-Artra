<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['firstname'];
	   	
		
	 			$query = 'UPDATE customer set FIRST_NAME ="'.$fname.'" 
				    WHERE CUST_ID ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Update Transaction Name Successfully.");
			window.location = "customer.php";
		</script>